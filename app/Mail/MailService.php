<?php

namespace App\Mail;


class MailService
{

  protected $fromTitle = '';

  public function __construct()
  {
    $this->fromTitle = 'Minh Le';
  }
}
