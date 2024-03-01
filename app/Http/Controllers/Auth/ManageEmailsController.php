<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Emails;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
 
class ManageEmailsController extends Controller
	{
	    /**
	     * Извлича списъка с получените заявки от имейлите в базата данни
	     *
	     * @return \Illuminate\Http\Response
	     */
	    public function index()
	    {
	        $emails = Emails::All();
	        return View("dashboard")->with('emails', $emails);
	    }
	 
	    /**
	     *Редакция на избран имейл.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function edit($id)
	    {
	        $email = Emails::Where('id', $id)
	                    ->get()->First();
	        return View("dashboard")->with('email', $email);
	    }
	 
	    /**
	     * Записва промените в базата данни.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function update(Request $request, $id)
	    {
	        $stat = Array("Получен", "Назначен е оператор", "Билета е затворен");
	        $email = Emails::Find($id);
	        $email->status = $request->status;
	        if($request->status != 0) $email->user_id = Auth::id(); else $email->user_id = 1;
	        $email->save();
	
	        // $emailResponse = $request->message . "Вашата заявка е със статус " . $stat[$request->status] . "\r\n------------------------------------------------------------------------\r\n" . $email->message;
	        // Mail::to($email->from)->send(new Contact($email, $emailResponse));
	 
	        $emails = Emails::All();
			return View("dashboard")->with('emails', $emails);
	    }
	 
	    /**
	     * Изтрива избран запис.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function destroy($id)
	    {
	        $ticket = Emails::Find($id);
	        $ticket->delete();
	        return redirect('/dashboard');
	    }
	}
