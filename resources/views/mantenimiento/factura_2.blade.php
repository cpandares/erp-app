<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .details, .items {
            margin-bottom: 20px;
        }
        .details table, .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table td, .items table th, .items table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .items table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura de Mantenimiento</h1>
            <p>Fecha: {{ date('d/m/Y') }}</p>
        </div>
        <div class="details">
            <h2>Detalles del Cliente</h2>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td>Pedor</td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td>Perez</td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td>
                        809-555-5555
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        pandare@mail.com
                    </td>
                </tr>
            </table>
        </div>
        <div class="items">
            <h2>Detalles del Mantenimiento</h2>
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mantenimiento as $mantenimiento)
                    <tr>
                        <td>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, rerum?
                        </td>
                        <td>
                            1
                        </td>
                        <td>
                            54444
                        </td>
                        <td>
                            54444
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <h2>Total: 44444</h2>
        </div>
    </div>
</body>
</html>