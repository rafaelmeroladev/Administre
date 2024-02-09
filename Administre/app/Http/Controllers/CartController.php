<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\OrderConfirmed;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $cart = auth()->user()->cart ?? auth()->user()->cart()->create();
        $product = Products::findOrFail($productId);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1]);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return Redirect::back()->with('success', 'Item adicionado ao carrinho.');
    }

    public function removeFromCart($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return redirect()->back()->with('success', 'Produto removido do carrinho com sucesso!');
    }

    public function confirmOrder(Request $request)
    {
        $admin = User::where('is_admin', true)->first();
        $admin->notify(new OrderConfirmed());

        return redirect()->route('cart.index')->with('success', 'Pedido confirmado! O administrador foi notificado.');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = auth()->user()->cart ?? null;
        if ($cart) {
            $cart->load('items.product'); // Carrega os produtos associados aos itens do carrinho
            $totalPrice = $cart->items->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        } else {
            $totalPrice = 0;
        }
        return view('cart.index', compact('cart', 'totalPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->update(['quantity' => $request->quantity]);
    
        // Retornar uma resposta JSON de sucesso
        return response()->json(['message' => 'Quantidade atualizada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
