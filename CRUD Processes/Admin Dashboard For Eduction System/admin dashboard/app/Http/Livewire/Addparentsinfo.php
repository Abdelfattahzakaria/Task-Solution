<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Bloodtybe;
use App\Models\Nationalit;
use App\Models\Pareent;
use App\Models\Parentattachment;
use App\Models\Religion;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use function Termwind\render;

class Addparentsinfo extends Component
{
    use WithFileUploads;
    public $catchError, $updateMode = false, $photos, $showParents = true, $Parent_id;
    public $successMessage = "";
    public $currentStep = 1,
        // Father_INPUTS 
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function render()
    {
        return view('livewire.addparentsinfo', [
            "Nationalities" => Nationalit::all(),
            "Type_Bloods" => Bloodtybe::all(),
            "Religions" => Religion::all(),
            "my_parents" => Pareent::all(),
        ]);
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:pareents,Email,' . $this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:pareents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:pareents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2;
    }
    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:pareents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:pareents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function back($index)
    {
        $this->currentStep = $index;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function submitForm()
    {
        try {
            $My_Parent = new Pareent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            //$My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->Name_Father_Ar = $this->Name_Father;
            $My_Parent->Name_Father_En = $this->Name_Father_en;
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            //$My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Job_Father_Ar = $this->Job_Father;
            $My_Parent->Job_Father_En = $this->Job_Father_en;
            $My_Parent->father_nationality_id  = $this->Nationality_Father_id;
            $My_Parent->father_bloodtybe_id  = $this->Blood_Type_Father_id;
            $My_Parent->father_religion_id  = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS 
            //$My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->Name_Mother_Ar = $this->Name_Mother;
            $My_Parent->Name_Mother_En = $this->Name_Mother_en;
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            //$My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Job_Mother_Ar = $this->Job_Mother;
            $My_Parent->Job_Mother_En = $this->Job_Mother_en;
            $My_Parent->mother_nationality_id = $this->Nationality_Mother_id;
            $My_Parent->mother_bloodybe_id  = $this->Blood_Type_Mother_id;
            $My_Parent->mother_religion_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;

            $My_Parent->save();

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) :
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), "parents_attachments");
                    Parentattachment::create([
                        "File_Name" => $photo->getClientOriginalName(),
                        "pareent_id" => Pareent::latest()->first()->id,
                    ]);
                endforeach;
            }

            $this->successMessage = trans("Parent_trans.successMessage");
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function showformadd()
    {
        $this->showParents = false;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function edit($id)
    {
        $this->showParents = false;
        $this->updateMode = true;
        $My_Parent = Pareent::where('id', $id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        //$this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father = $My_Parent->Name_Father_Ar;
        $this->Name_Father_en = $My_Parent->Name_Father_En;
        $this->Job_Father = $My_Parent->Job_Father_Ar;
        $this->Job_Father_en = $My_Parent->Job_Father_En;
        $this->National_ID_Father = $My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->father_nationality_id;
        $this->Blood_Type_Father_id = $My_Parent->father_bloodtybe_id;
        $this->Address_Father = $My_Parent->Address_Father;
        $this->Religion_Father_id = $My_Parent->father_nationality_id;

        $this->Name_Mother = $My_Parent->Name_Mother_Ar;
        $this->Name_Mother_en = $My_Parent->Name_Mother_En;
        $this->Job_Mother = $My_Parent->Job_Mother_Ar;
        $this->Job_Mother_en = $My_Parent->Job_Mother_En;
        $this->National_ID_Mother = $My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->mother_nationality_id;
        $this->Blood_Type_Mother_id = $My_Parent->mother_nationality_id;
        $this->Address_Mother = $My_Parent->Address_Mother;
        $this->Religion_Mother_id = $My_Parent->mother_religion_id;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function submitForm_edit(){
      if($this->Parent_id){
        $record= Pareent::findOrFail($this->Parent_id); 
        $record->update([
            'Passport_ID_Father' => $this->Passport_ID_Father,
            'National_ID_Father' => $this->National_ID_Father,
        ]);
        $this->currentStep = 1;
        $this->showParents = true;
        $this->updateMode = false;
        return View("livewire/addparentsinfo");  
      }
    }   
    //---------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------
    public function delete($id){
      Pareent::findOrFail($id)->delete();  
      return View("livewire/addparentsinfo");
    }   
}
     