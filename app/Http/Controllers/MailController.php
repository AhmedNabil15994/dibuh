<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Dashboard\SalesInvoiceController;

use Mail;
use App\Models\SalesInvoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email($id){


     SalesInvoiceController::draft_to_invoice($id);
      $data = array('name'=>"Virat Gandhi");

      Mail::send( $data, function($message) {
         $message->to('mahmoud.shedeed@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('mahmoud.shedeed@gmail.com','Virat Gandhi');
      });
      SalesInvoiceController::show($id);
  
   }

   public function html_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('emails.mail', $data, function($message) {
         $message->to('mahmoud.shedeed@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('mahmoud.shedeed@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }

   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('emails.mail', $data, function($message) {
         $message->to('mahmoud.shedeed@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('D:\xampp\htdocs\laravel\mamlakty\public\uploads\news\1468278373.jpg');
         $message->attach('D:\xampp\htdocs\laravel\mamlakty\public\uploads\news\1468278799.jpg');
         $message->from('mahmoud.shedeed@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
