<?php

use App\Factories\EntityFactory;

require __DIR__.'/vendor/autoload.php';

// use App\Entities\Payment;

// ===============================
// $payment = new Payment();

// $payment->setIntallments(11);

// $payment->setAmount(0);
// ===============================

// O desafio é remover os setters da classe Payment
// e implementar a classe EntityFactory para valide
// e traga a instancia correta
$entityFactory = new EntityFactory('Payment');

$payment = $entityFactory->create((object) [
    'installments' => 13, // <-- Will throw an AttributeException
    'amount' => 123.22,
]);

var_dump($payment);
