<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Rest\ApiContext as PayPal;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

class PaymentsController extends Controller
{

    protected $paypal;
    protected $payer;
    protected $item;
    protected $item_list;
    protected $details;
    protected $price;
    protected $amount;
    protected $transaction;
    protected $redirectUrls;
    protected $payment;

    public function __construct(
        Payer $payer,
        Item $item,
        ItemList $itemList,
        Details $details,
        Amount $amount,
        Transaction $transaction,
        RedirectUrls $redirectUrls,
        Payment $payment
    )
    {
        $this->middleware('auth');

        $this->paypal       = resolve(PayPal::class);
        $this->price        = config('paypal.premium_cost');
        $this->payer        = $payer;
        $this->item         = $item;
        $this->item_list    = $itemList;
        $this->details      = $details;
        $this->amount       = $amount;
        $this->transaction  = $transaction;
        $this->redirectUrls = $redirectUrls;
        $this->payment      = $payment;
    }




    public function checkout()
    {
        try {
            $this->payment()->create($this->paypal);
        } catch (\Exception $e) {
            die($e);
        }

        echo $approvalUrl = $this->payment->getApprovalLink();
    }











    /**
     * sets a payer instance with parameters
     */
    public function payer()
    {
        $this->payer->setPaymentMethod('paypal');
        return $this->payer;
    }


    /**
     * sets item info to its object
     */
    public function item()
    {
        $this->item->setName('Premium Membership')
                   ->setCurrency('USD')
                   ->setQuantity(1)
                   ->setPrice($this->price);
        return $this->price;
    }


    /**
     * @param array $items
     *
     * sets an item list
     */
    public function itemList(array $items = [])
    {
        $this->item_list->setItems($items);
        return $this->item_list;
    }


    /**
     * @param int $shipping
     *
     * sets details about an item
     */
    public function details($shipping = 0)
    {
        $this->details->setShipping($shipping)->setSubtotal($this->getTotal($shipping));
        return $this->details;
    }


    /**
     * @param int $shipping
     *
     * @return mixed
     *
     * calculates the total cost
     */
    public function getTotal($shipping = 0)
    {
        return $this->price + $shipping;
    }


    /**
     * sets total amount to pay along with currency
     */
    public function amount()
    {
        $this->amount->setCurrency('USD')
             ->setTotal($this->getTotal($shipping = 0))
             ->setDetails($this->details);
        return $this->amount;
    }


    /**
     * sets transaction's params
     */
    public function transaction()
    {
        $this->transaction->setAmount($this->amount)
             ->setItemList($this->item_list)
             ->setDescription($description = 'Premium Membership in Quizland')
             ->setInvoiceNumber($token = uniqid());

        return $this->transaction;
    }


    /**
     *
     * Sets redirect URLs
     *
     */
    public function redirectUrls()
    {
        $this->redirectUrls->setReturnUrl(config('paypal.redirect_url') . '?success=true')
             ->setCancelUrl(config('paypal.redirect_url') . '?success=false');
        return $this->redirectUrls();
    }


    /**
     *
     * Sets payment's params
     *
     */
    public function payment()
    {
        $this->payment->setIntent('sale')
             ->setPayer($this->payer())
             ->setRedirectUrls($this->redirectUrls())
             ->setTransactions($this->transaction());
        return $this->payment;
    }








}
