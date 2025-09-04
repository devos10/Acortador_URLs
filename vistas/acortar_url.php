<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Para HTMX-->
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js"></script>
    <!--Para las alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Para bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Acortador de URLs</title>
</head>

<body class="text-light">
    <div class="container py-5" style="max-width: 760px;">
        <div class="text-center mb-4">
            <h1 class="h3">Acortador de URLs</h1>
            <p class="text-secondary">Bootstrap + HTMX + PHP</p>
        </div>


      <form class="card p-4 shadow border-0" method="GET" hx-get="../php/acortar_url.php" style="background:#111827"
      hx-target="#resultado" hx-swap="innerHTML">
    <div class="mb-3">
        <label class="form-label text-white">URL larga</label>
        <input type="url" name="url" class="form-control" placeholder="https://..." required>
        <div class="form-text text-secondary">Solo http/https</div>
    </div>
    <div class="row g-4 d-flex justify-content-center"> <!-- Centra todo el contenido de la fila -->
        <div class="col-md-4">
            <input name="alias" class="form-control" placeholder="Alias opcional (ej. evento2025)">
        </div>
        <div class="col-md-4"> <!-- Centra el campo de expiración -->
            <select class="form-select" name="expiracion" aria-label="Expiración">
                <option value="">Sin expiración</option>
                <option value="1">Expira en 1 día</option>
                <option value="7">Expira en 7 días</option>
                <option value="30">Expira en 30 días</option>
            </select>
        </div>
        <div class="col-md-4  d-flex justify-content-end">
            <button type="submit" class="button raise">Enviar</button>
        </div>
    </div>
</form>
<div id="resultado" class="mt-3"></div>


</body>

</html>