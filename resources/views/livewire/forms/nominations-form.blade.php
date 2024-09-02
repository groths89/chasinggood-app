<div x-data="{ progress: 0 }">
<form class="space-y-8" enctype="multipart/form-data" method="POST">
    @csrf
    <div>
        <div class="container mx-auto">
            <div class="section">
                <div class="p-4 border rounded">
                    <h2 class="text-lg font-bold">Basic Details</h2>
                    <div class="flex flex-row mb-3">
                        <x-wui-input wire:model="first_name" placeholder="First Name" label="First Name *[Required]" type="text" id="firstName" name="first_name" class="block w-full px-4 py-4 mx-1 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        @error('first_name') @enderror
                        <x-wui-input wire:model="last_name" placeholder="Last Name" label="Last Name *[Required]"  type="text" id="lastName" name="last_name" class="block w-full px-4 py-4 mx-1 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        @error('last_name') @enderror
                    </div>
                    <div class="flex flex-row mb-3">
                        <x-wui-input wire:model="email_address" placeholder="Email Address" label="Email Address *[Required]"  type="email" id="emailAddress" class="block w-full px-4 py-4 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        @error('email_address') @enderror
                    </div>
                    <div class="flex flex-row mb-3">
                        <x-wui-phone wire:model="phone_number" placeholder="Phone Number" label="Phone Number *[Required]"  type="phone" id="phoneNumber" :mask="['(###) ###-####', '+# ### ###-####']" class="block w-full px-4 py-4 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        @error('phone_number') @enderror
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="p-4 border rounded">
                    <h2 class="text-lg font-bold">Nominations Details</h2>
                    <div>
                        <x-wui-card title="Who are you nominating? *[Required]">
                            <div class="space-y-2" x-data="{ nominationCategory: '' }">
                                <x-wui-radio wire:model="nominating_category" @class(['m-4']) lg id="self" label="Self: Are you nominating yourself?" name="nominationRadio" x-model="nominationCategory" wire:click="populateFields" value="Self" />
                                <x-wui-radio wire:model="nominating_category" @class(['m-4']) lg id="organization" label="Organization: Are you nominating an organization?" name="nominationRadio" x-model="nominationCategory" wire:click="populateFields" value="Organization" />
                                <x-wui-radio wire:model="nominating_category" @class(['m-4']) lg id="adult_individual" label="Adult Individual (18+): Are you nominating an indivudual that is 18 or older?" name="nominationRadio" x-model="nominationCategory" wire:click="populateFields" value="Adult Individual (18+)" />
                                <x-wui-radio wire:model="nominating_category" @class(['m-4']) lg id="teen_individual" label="Teen Individual (ages 13-17): Are you nominating an individual that is a teenager from ages 13 to 17?" name="nominationRadio" x-model="nominationCategory" wire:click="populateFields" value="Teen Individual (Ages 13-17)" />
                                @error('nominating_category') @enderror
                                <div x-show="nominationCategory === 'Organization' || nominationCategory === 'Adult Individual (18+)' || nominationCategory === 'Teen Individual (Ages 13-17)'">
                                    <x-wui-input wire:model="nominee_name" placeholder="Nominee Name/Organization Name" type="text" id="nomineeName" name="nominee_name" class="block w-full px-4 py-4 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                    <x-wui-input wire:model="nominee_email" placeholder="Nominee Email Address" type="text" id="nomineeEmail" class="block w-full px-4 py-4 mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />                               
                                </div>
                                @error('nominee_name') @enderror
                                @error('nominee_email') @enderror                                                       
                            </div>
                        </x-wui-card>

                        <x-wui-select
                        wire:model="nj_county"
                        class="w-full px-4 py-4 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        label="Search for a NJ County *[Required]"
                        placeholder="Select NJ County"
                        :options="[
                            'Atlantic County',
                            'Bergen County',
                            'Burlington County',
                            'Camden County',
                            'Cape May County',
                            'Cumberland County',
                            'Essex County',
                            'Gloucester County',
                            'Hudson County',
                            'Hunterdon County',
                            'Mercer County',
                            'Middlesex County',
                            'Monmouth County',
                            'Morris County',
                            'Ocean County',
                            'Passaic County',
                            'Salem County',
                            'Somerset County',
                            'Sussex County',
                            'Union County',
                            'Warren County'
                        ]"
                        />
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="p-4 border rounded">
                    <h2 class="text-lg font-bold">Story Details</h2>
                    <div class="story-suggestions">
                        <div class="p-4 bg-yellow-200 rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-yellow-600 size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                              
                            <h3 class="mb-4 text-gray-700">Things to think about when telling your story:</h3>
                            <ol class="text-gray-500 list-decimal list-inside">
                                <li>Tell us a little bit about yourself or your organization.</li>
                                <li>What does your organization do and how long has it been around?</li>
                                <li>What impact has your “good deed” had on you? On others?</li>
                                <li>Why do you think you are a good candidate for this award?</li>
                            </ol>
                        </div>
                    </div>
                    <div class="m-4">
                        <div class="container p-4 mx-auto">
                            <div class="editor-container">
                                <textarea wire:model="story_essay" max_words="500" id="editor" class="w-full h-64 p-2 border rounded"></textarea>
                                @error('story_essay') @enderror
                            </div>
{{--                             <div class="flex justify-center mt-4 space-x-2 toolbar">
                              <button id="bold-button" class="px-2 py-1 text-white bg-blue-500 rounded">Bold</button>
                              <button id="italic-button" class="px-2 py-1 text-white bg-green-500 rounded">Italic</button>
                              <button id="underline-button" class="px-2 py-1 text-white bg-yellow-500 rounded">Underline</button>
                              <button id="strikethrough-button" class="px-2 py-1 text-white bg-purple-500 rounded">Strikethrough</button>
                              <button id="color-picker-button" class="px-2 py-1 text-white bg-pink-500 rounded">Color</button>
                              <input type="color" id="color-picker" class="hidden">
                            </div> --}}
                        <p class="text-xs">(please limit to 500 words or less)</p>
                        </div>
                    </div>
                    {{-- <div class="items-center m-4">
                        <label for="fileUpload" class="mr-2 text-gray-700">Video Upload:</label>
                        <input wire:model="uploaded_video" id="fileUpload" type="file" accept="video/*">
                        <div class="fileUpload min-w-[150px] max-w-[500px] inline-block cursor-pointer">
                          <button type="button" class="p-2 bg-gray-200 rounded-full upload-btn hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path d="M9.25 13.25a.75.75 0 0 0 1.5 0V4.636l2.955 3.129a.75.75 0 0 0 1.09-1.03l-4.25-4.5a.75.75 0 0 0-1.09 0l-4.25 4.5a.75.75 0 1 0 1.09 1.03L9.25 4.636v8.614Z" />
                                <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                            </svg>                                                          
                          </button>
                        </div>
                        @if ($uploaded_video)
                            <video controls>
                                <source src="{{ $uploaded_video }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>                            
                        @endif
                        <div class="ml-4 text-sm italic text-red-500">*max 2 minute video</div>
                      </div> --}}
                </div>
            </div>
            <div class="section">
                <div>
                    <details class="cursor-pointer group">
                        <summary class="flex items-center p-2 font-bold group-open:text-blue-500">
                          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414   
                       1.414L11.414 12l2.828 2.828a1 1 0 01-1.414 1.414L10 13.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 12l-2.828-2.828a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                          Nomination License and Consent Agreement [This is required, click here to view and accept]
                        </summary>
                        <div class="p-2 text-gray-700">
                            <div class="p-4 nlca_container">
                                <p class="mb-4 text-2xl font-bold text-gray-800 nlca_header">Nomination License and Consent Agreement</p>
                                <p class="mb-2 text-gray-600">Last updated: March 9, 2022</p>
                                <p class="mb-2 text-gray-600">Please carefully read the following Nomination License and Consent Agreement (the “Agreement”) by and between Chasing Good, a corporation organized under the laws of the State of New Jersey (“Chasing Good”), and you, as a requesting Nominating Party seeking to submit a Nomination on behalf of a Nominated Party(as those terms are defined in Chasing Good’s Privacy Policy).</p>
                                <p class="mb-2 text-gray-600">As used in this Agreement, unless otherwise specified or not applicable, the terms “we,” “us” and “our” shall mean Chasing Good, the owner of the website at http://chasinggood.org (the “Site”) and the provider of the services offered by or through the Site (collectively, the “Services”), including those Services directed towards the Nomination and award process to recognize individuals for their volunteer and charitable works as may be determined by Chasing Good (in each such case, the “Nomination Process”).  As used in this Agreement, unless otherwise specified or not applicable, the terms “you” and/or “your” specifically means you, as a Nominating Party engaging in the Nomination Process of a Nominated Party for potential recognition by Chasing Good.</p>
                                <p class="mb-2 text-gray-600">In addition to the terms and provisions of our Privacy Policy, which are incorporated by reference in their entirety into this Agreement, the following additional terms and conditions shall apply to each Nomination submitted by you to Chasing Good.  In order to submit a Nomination, you must expressly agree to the terms and conditions of this Agreement by providing to Chasing Good the requested information in the Nomination form and checking the appropriate box(es) at the bottom of this Agreement.  If you do not agree to the terms and conditions of this Agreement, or are otherwise unable to do so, then do not submit the Nomination.  By checking the applicable box(es) at the bottom of this Agreement, you expressly warrant, represent, and agree that the information in the Nomination form is true and accurate and that you agree to be bound by the terms and conditions of this Agreement.</p>
                                <ol type="1" class="mb-4 ml-4 list-decimal list-inside">
                                    <li class="mb-2 text-gray-600">
                                        <strong>License to Content.</strong> When submitting a Nomination to Nominate an individual for recognition by Chasing Good, you, as the Nominating Party, will be required to submit various content through our Nomination form.  Submitted content shall include written content as to the Nominating Party, including that party’s name, email address, and pertinent information in support of the Nomination, i.e., a narrative by you as to why the Nominated Party deserves recognition.  Submitted content may also comprise, at your discretion, photographic images and/or recorded video in digital format (in all such cases, “Digital Content”).  By submitting Digital Content, you expressly understand, acknowledge, and agree to the following provisions:
                                        <ol type="A" class="ml-4 list-disc list-inside">
                                            <li class="mb-2"><strong>Owner/Creator/Permission.</strong> You are the creator/owner of all submitted Digital Content or have the express, written permission by the creator/owner of the Digital Content to use that content for purposes of Nominating the Nominated Party and to grant the license rights to us as set forth below.  In the event you are not the creator/owner of the Digital Content but have the express written permission by the creator/owner of that content to use it in the Nomination Process, you have the express written authorization by that third party creator/owner to grant to Chasing Good the license rights set forth below.</li>
                                            <li class="mb-2"><strong>Grant of License by Creator/Owner.</strong> As the creator/owner of the Digital Content, or with the express, written permission by and from the creator/owner of the Digital Content, upon submission thereof to us, you hereby grant to Chasing Good an irrevocable, perpetual, royalty-free, fully-paid up, non-exclusive license to use the Digital Content for the Nomination Process, potential recognition of the Nominated Party by Chasing Good, promotional, marketing and public relations efforts (including, but not limited to, through third party platforms, media outlets and the Site), or any other manner in Chasing Good’s sole and absolute discretion.</li>
                                        </ol>
                                    </li>
                                    <li class="mb-2"><strong>Consent/Express Permission by Parent/Guardian.</strong> If the Nominated Party is under the age of eighteen (18) years of age, and you, as the Nominating Party, are not a parent or legal guardian of the Nominated Party, you have the express written permission of a parent or legal guardian of the Nominated Party to use any Digital Content in which the minor Nominated Party is depicted.  Upon request by Chasing Good, you agree to provide to us a digital, legible copy of that written consent for our records.  Failure to provide a copy of the written consent may result in termination of the Nomination Process as to a minor Nominated Party and render the minor Nominated Party ineligible for recognition by Chasing Good.</li>
                                    <li class="mb-2"><strong>Indemnity.</strong> You agree to indemnify and hold Chasing Good, and, as applicable, its parent, subsidiaries, affiliates, officers, agents, co-branders or other partners, and employees, harmless from any claim or demand, including reasonable attorneys’ fees, made by any third party due to or arising out of your violation of any term, condition or obligation of this Agreement, or your violation of any rights of another.</li>
                                    <li class="mb-2"><strong>Law.</strong> This Agreement shall be deemed to have been made in the State of New Jersey, United States of America and all matters arising from or relating in any manner to the subject matter of this Agreement shall be interpreted, and the rights and liabilities of the parties determined, in accordance with the Laws of the State of New Jersey applicable to agreements executed, delivered, and performed within such State, without regard to the principles of conflicts of Laws thereof.  As part of the consideration for value received, you further consent to the exclusive jurisdiction of any state or federal court located within the State of New Jersey with respect to all matters arising from or relating in any manner to the subject matter of this Agreement.  With respect to all matters arising from or relating in any manner to the subject matter of this Agreement, you further hereby: (a) waive any objection to New Jersey as the venue of any action instituted hereunder, and (b) consent to the granting of such legal or equitable relief as is deemed appropriate by any aforementioned court.</li>
                                </ol>
                                <p class="mb-4 italic text-gray-500 nlca_fine_print">
                                    As the Nominating Party in this Nomination, I expressly warrant and represent that: 1) I am the creator/owner of all Digital Content submitted with the Nomination or otherwise have the express, written consent from the creator/owner of the Digital Content to use it in this Nomination for the purposes stated above, 2) I have the authority to grant to Chasing Good the license rights to the Digital Content as set forth above, and 3) If the Nominated Party is under the age of eighteen (18) years of age, I am either a parent or legal guardian of the Nominated Party or otherwise have the express written permission of a parent or legal guardian of the Nominated Party to use the Digital Content in which the minor Nominated Party is depicted.  I further expressly, warrant and represent that, upon request by Chasing Good, I will provide to Chasing Good a digital, legible copy of the written consent by the Nominated Party’s parent or legal guardian.
                                </p>
                                <div class="btn_container">
                                    <div class="flex items-center mb-4">
                                        <input wire:model="disclaimer_agreed" type="checkbox" value="theChkAcceptTerms" id="disclaimer" [checked]="theChkAcceptTerms" /><span class="ml-2 text-gray-600">I Agree to the License and Consent Disclaimer of ChasingGood</span>                              
                                        @error('disclaimer_agreed') @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
            <div wire:ignore>
            </div>
            @if($errors->any())
            <div class="p-4 bg-red-300 border border-red-600 rounded-md error-messages">
                <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2 font-semibold text-red-600">{{ $error }}</li>                 
                @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('message'))
                <x-wui-alert title="Successsfully Submitted!" positive type="success" wire:loading.remove wire:target="submitGoodDeed">
                    {{ session()->get('message') }}
                </x-wui-alert>
            @endif             
            <div class="flex flex-row justify-between my-3"> 
                <button class="float-right px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" type="button" wire:click="submit">Submit</button>    
            </div>

        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('progressData', () => ({
                    progress: 0,
                    formActive: false,
        
                    updateProgress() {
                        // Calculate progress based on form completion
                        this.progress = (this.$refs.form.elements.length / this.$refs.form.elements.filter(el => el.value !== '').length) * 100;
                    },
        
                    submitForm() {
                        // Handle form submission
                        this.formActive = false;
                    }
                }));
            });
        </script>    
    </div>
    <div>
           
    </div>
</form>
</div>