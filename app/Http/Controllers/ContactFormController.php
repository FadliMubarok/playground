<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;

class ContactFormController extends Controller
{
    public function create()
    {
        $dataSelect = [
            'Kerusakan Fasilitas Umum' => 'Kerusakan Fasilitas Umum',
            'Pungutan Liar' => 'Pungutan Liar',
            'Pelayanan Publik' => 'Pelayanan Publik',
        ];

        return view('contact-form.create', compact('dataSelect'));
    }

    public function store(\App\Http\Requests\ContactForm\Store $request)
    {
        // Query Builder
        DB::table('contact_forms')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'handphone' => $request->handphone,
            'kategori' => $request->kategori,
            'message' => $request->message,
        ]);

        DB::table('contact_forms')->insert($request->only(['name', 'email', 'handphone', 'kategori', 'message']));
        DB::table('contact_forms')->insert($request->except(['_token']));
        DB::table('contact_forms')->insert($request->validated());

        // Model Instance
        $contactForm = new ContactForm();
        $contactForm->name = $request->name;
        $contactForm->email = $request->email;
        $contactForm->handphone = $request->handphone;
        $contactForm->kategori = $request->kategori;
        $contactForm->message = $request->message;
        $contactForm->save();

        //Mass Assignment
        ContactForm::create($request->validated());

        return redirect()->back()->withSuccess('Pesan telah diterima dan menunggu tindak lanjut.');
    }
}
