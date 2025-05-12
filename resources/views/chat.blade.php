<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1 {
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            height: 200px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        pre {
            background-color: #f5f5f5;
            padding: 15px;
            overflow: auto;
            border: 1px solid #ddd;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Générateur de CV</h1>

    <!-- Message d'erreur -->
    @if(isset($error))
        <div class="error">{{ $error }}</div>
    @endif

    <!-- Formulaire simple -->
    <form method="POST" action="{{ route('openai.autoCV') }}">
        @csrf
        <div>
            <label for="description">Décrivez votre parcours professionnel :</label>
            <textarea id="description" name="description" required>{{ $description ?? '' }}</textarea>
        </div>
        <button type="submit">Générer mon CV</button>
    </form>

    <!-- Affichage simple du résultat JSON -->
    @if(isset($cvJson))
        <h2>Résultat :</h2>
        <pre>{{ $cvJson }}</pre>
    @endif
</body>
</html>
