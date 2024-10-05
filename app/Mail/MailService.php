<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use App\Models\SettingModel;

class MailService
{

  protected $fromTitle = '';

  public function __construct()
  {
    $this->fromTitle = 'Minh Le';
  }

  public function sendMailConfirm($data)
  {
    $mail = json_decode(SettingModel::where('key_value', 'setting-email-account')->first()->value, true);
    if (empty($mail)) {
      return false;
    } else {
      Mail::send([], [], function ($message) use ($mail, $data) {
        $message->from($mail['email_account_username'], $this->fromTitle);
        $message->to($data['email']);
        $message->subject($this->fromTitle . '- Thông báo gửi liên hệ thành công');

        $content = sprintf(
          '
            <p>Xin chào, %s</p>
            <p>Chúng tôi đã nhận được thông tin của bạn và sẽ liên hệ trong thời gian sớm nhất.</p>
            <p>Xin cảm ơn</p>
          ',
          $data['full_name']
        );
        $message->setBody($content, 'text/html');
      });
      return true;
    }
  }


  public function sendMailInfo($data)
  {
    $mail = json_decode(SettingModel::where('key_value', 'setting-email-account')->first()->value, true);
    if (empty($mail)) {
      return false;
    } else {
      Mail::send([], [], function ($message) use ($mail, $data) {
        $bcc = json_decode(SettingModel::where('key_value', 'setting-email-bcc')->first()->value, true);
        $bcc = explode(',', $bcc['email_bcc']);
        $message->from($mail['email_account_username'], $this->fromTitle);
        $message->bcc($bcc);
        $message->subject('[TEST] Thông tin liên hệ mới từ ' . $data['full_name']);

        $content = sprintf(
          '
            <p>Nhận được thông tin liên hệ mới từ khách hàng</p>
            <p>Name: %s</p>
            <p>Email: %s</p>
            <p>Phone: %s</p>
            <p>Message: %s</p>
          ',
          $data['full_name'],
          $data['email'],
          $data['phone'],
          $data['message'],
        );
        $message->setBody($content, 'text/html');
      });
      return true;
    }
  }
}
