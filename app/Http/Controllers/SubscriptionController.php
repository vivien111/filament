<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    // Afficher la page d'abonnement
    public function create()
    {
        // Logique pour afficher l'interface de création d'abonnement (si nécessaire)
        return view('subscription.create');
    }

    // Créer un abonnement via Stripe
    public function store(Request $request)
    {
        // Valider les informations du formulaire
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Assurez-vous que Stripe est correctement configuré
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Créer un abonnement
        try {
            $user = auth()->user();

            // Attach payment method to the user
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($request->payment_method);

            // Créer un abonnement Stripe
            $subscription = $user->newSubscription('default', 'price_1JX4KXEZ2wVwQpc7aq0kpfQO') // Remplace par ton plan Stripe
                ->create($request->payment_method);

            // Enregistrer l'abonnement dans la base de données
            $user->update([
                'stripe_subscription' => $subscription->id,
                'stripe_status' => $subscription->status,
            ]);

            return redirect()->route('dashboard')->with('success', 'Abonnement créé avec succès!');
        } catch (\Exception $e) {
            return redirect()->route('subscription.create')->with('error', 'Erreur lors de la création de l\'abonnement : ' . $e->getMessage());
        }
    }

    // Annuler un abonnement
    public function cancel()
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur a un abonnement actif
        if ($user->subscription('default')) {
            // Annuler l'abonnement
            $user->subscription('default')->cancel();

            // Mettre à jour l'état de l'abonnement dans la base de données
            $user->update([
                'stripe_status' => 'canceled',
            ]);

            return redirect()->route('dashboard')->with('success', 'Abonnement annulé avec succès!');
        }

        return redirect()->route('dashboard')->with('error', 'Aucun abonnement actif trouvé.');
    }

    // Mettre à jour l'abonnement
    public function update(Request $request)
    {
        // Logique pour mettre à jour les informations d'abonnement
    }
}
