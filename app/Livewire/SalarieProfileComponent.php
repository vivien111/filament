<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SalarieProfileComponent extends Component
{
    public $nom;
    public $prenom;
    public $email;
    public $password;

    public function mount()
    {
        $user = Auth::user();
        $this->nom = $user->salarie->nom ?? '';
        $this->prenom = $user->salarie->prenom ?? '';
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6',
        ]);

        $user = Auth::user();
        $user->email = $this->email;
        
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $user->salarie->update([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
        ]);

        session()->flash('success', 'Profil mis à jour avec succès.');
    }

    public function render()
    {
        return view('livewire.salarie-profile-component');
    }
}
