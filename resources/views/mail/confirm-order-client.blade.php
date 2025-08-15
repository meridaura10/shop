<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Підтвердження замовлення</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
<h2>Підтвердження замовлення</h2>

<p font-weight: bold; margin-top: 20px;">
    Загальна сума замовлення: {{ $order->amount }} грн
</p>

<p>Якщо у вас є питання, будь ласка, зв’яжіться з нами.</p>

<p>З повагою,<br>{{ config('app.name') }}</p>
</body>
</html>
