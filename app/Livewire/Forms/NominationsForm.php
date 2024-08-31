<?php

namespace App\Livewire\Forms;

use App\Mail\NominationMailable;
use App\Mail\ThankYouMailable;
use App\Mail\ThankYouSelfMailable;
use Livewire\Component;
use App\Models\Nomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NominationsForm extends Component
{
    public $first_name;
    public $last_name;
    public $email_address;
    public $phone_number;
    public $nominating_category;
    public $nominee_name;
    public $nominee_email;
    public $nj_county;
    public $story_essay;
    public $uploaded_video;
    public $disclaimer_agreed;

    public $step = 1;
    public $nomination_category = "";

    protected $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email_address' => 'required|email',
        'phone_number' => 'required|regex:^\d{10,11}$^',
        'nominating_category' => 'required',
        'nominee_name' => 'required',
        'nominee_email' => 'required|email',
        'nj_county' => 'required',
        'story_essay' => 'required',
        'disclaimer_agreed' => 'required'
    ];

    protected $messages = [
        'phone_number.regex' => 'The format of the phone number is either 10 or 11 digits.',
        'nj_county.required' => 'Please select a New Jersey county it is a required field.',
        'disclaimer_agreed.required' => 'You must read and accept the Nomination License and Consent Agreement.'
    ];

    public function populateFields()
    {
        if (in_array($this->nominating_category, ['Organization', 'Adult Individual (18+)', 'Teen Individual (Ages 13-17)'])) {
            $this->reset('nominee_name', 'nominee_email');
        } else {
            // Get the name and email values from the form fields
            $name = $this->first_name . " " . $this->last_name;
            $email = $this->email_address;

            // Populate the fields in the Livewire component
            $this->nominee_name = $name;
            $this->nominee_email = $email;
        }
    }

    public function submit(Request $request)
    {
        $this->validate();

        Nomination::create(
            $this->only([
                'first_name',
                'last_name',
                'email_address',
                'phone_number',
                'nominating_category',
                'nominee_name',
                'nominee_email',
                'nj_county',
                'story_essay',
                'uploaded_video',
                'disclaimer_agreed'
            ])
        );

        $nominee_name = $request->input('nominee_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');

        // Create a new Mailable instance
        $mailable = new ThankYouMailable($first_name, $last_name, $nominee_name);
        $mailabe2 = new NominationMailable($first_name, $last_name, $nominee_name);
        $mailable3 = new ThankYouSelfMailable($first_name, $last_name);

        if ($this->email_address == $this->nominee_email) {
            Mail::to($this->email_address)->send($mailable3);
        } else {
            Mail::to($this->email_address)->send($mailable);
            Mail::to($this->nominee_email)->send($mailabe2);
        }

        return redirect('/');
    }

    public function mount()
    {
        $this->populateFields();
    }

    public function render()
    {
        return view('livewire.forms.nominations-form');
    }
}
