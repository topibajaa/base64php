<?php
$encoded = '';
$decoded = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['encode'])) {
        $input = $_POST['text'] ?? '';
        $encoded = base64_encode($input);
    } elseif (isset($_POST['decode'])) {
        $input = $_POST['text'] ?? '';
        $decoded = base64_decode($input, true);
        if ($decoded === false) {
            $decoded = '❌ Base64 tidak valid.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Base64 Encoder & Decoder</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 700px;
        }
        textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            margin-top: 10px;
            font-size: 14px;
            font-family: monospace;
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            margin: 10px 5px 20px 0;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }
        button:hover {
            background: #1e40af;
        }
        .output {
            position: relative;
        }
        .copy-btn {
            position: absolute;
            right: 10px;
            top: 5px;
            background: #10b981;
            border: none;
            padding: 6px 12px;
            color: white;
            font-size: 12px;
            cursor: pointer;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🧬 Base64 Encode & Decode</h2>
    <form method="POST">
        <label>Masukkan Teks:</label>
        <textarea name="text" required><?= htmlspecialchars($_POST['text'] ?? '') ?></textarea>
        <br>
        <button name="encode">🔐 Encode</button>
        <button name="decode">🔓 Decode</button>
    </form>

    <?php if (!empty($encoded)): ?>
        <div class="output">
            <label>Hasil Encode:</label>
            <textarea id="encodedResult" readonly><?= htmlspecialchars($encoded) ?></textarea>
            <button class="copy-btn" onclick="copyToClipboard('encodedResult')">Salin</button>
        </div>
    <?php endif; ?>

    <?php if (!empty($decoded)): ?>
        <div class="output">
            <label>Hasil Decode:</label>
            <textarea id="decodedResult" readonly><?= htmlspecialchars($decoded) ?></textarea>
            <button class="copy-btn" onclick="copyToClipboard('decodedResult')">Salin</button>
        </div>
    <?php endif; ?>
</div>

<script>
function copyToClipboard(id) {
    const text = document.getElementById(id);
    text.select();
    text.setSelectionRange(0, 99999); // For mobile
    document.execCommand("copy");
    alert("Teks disalin!");
}
</script>
</body>
</html>
