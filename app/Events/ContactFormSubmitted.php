<?php

namespace App\Events;

use App\Models\ContactForm;

class ContactFormSubmitted
{
    public $contactForm;

    public function __construct(ContactForm $contactForm)
    {
        $this->contactForm = $contactForm;
    }
}
