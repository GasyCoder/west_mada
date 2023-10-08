<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $getReference }}</title>
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

       @page {
        size: 12.5cm 17.6cm;
        margin: 0;
        }
        
        body {
        width: 12.5cm;
        height: 17.6cm;
        margin: 0;
        font-family: DejaVu Sans;
        font-size: 10px;
        font-weight: normal;
        }

       .invoice {
        width: 12.2cm; /* Ajustez la largeur pour correspondre à la taille de papier B6 tout en laissant un peu de marge */
        margin: 0;
        padding: 0;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }

        .invoice-action {
            text-align: right;
            margin-bottom: 20px;
        }

        .invoice-action a {
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            background-color: #fff;
            border: 1px solid #e74c3c;
            color: #e74c3c;
            text-decoration: none;
        }

        .invoice-action a:hover {
            background-color: #e74c3c;
            color: #fff;
        }

        .invoice-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details ul {
            list-style: none;
            padding: 0;
        }

        .invoice-details ul li {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-bills table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; /* Utilisez une largeur de tableau fixe pour contrôler la largeur des colonnes */
        }

        /* Ajustez les largeurs des colonnes en fonction des classes attribuées */
        .invoice-bills th,
        .invoice-bills td {
        border: 1px solid #b9b9b9;
        padding: 8px;
        text-align: center;
        }

        /* Largeur de la colonne "Désignation" plus grande */
        th.w-designation,
        td.w-designation {
        width: 40%; /* Ajustez la largeur selon vos besoins */
        }
        
        /* Largeur des autres colonnes plus petites */
        th.w-small,
        td.w-small {
        width: 12%; /* Ajustez la largeur selon vos besoins */
        }
        td.w-price{
            width: 20%;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }

        .invoice-total span {
            font-weight: bold;
        }

        .invoice-notes {
            margin-top: 12px;
            font-style: italic;
            font-size: 12px;
            color: #888;
            text-align: right;
        }
    </style>
</head>

<body>
    
    <div class="invoice">
        <div class="invoice-action" id="pdfButton">
            <a class="btn btn-icon btn-sm btn-white btn-dim btn-outline-danger" id="pdfButton" href="#"
                wire:click.prevent="generatePDF()">
                <em class="icon ni ni-file-pdf"></em>
            </a>
        </div>
        <div class="invoice-head">
            <div class="invoice-title">
                <em class="icon ni ni-file"></em> BON D'ACHAT
            </div>
            <div class="invoice-details">
                <ul>
                    {{-- <li>Réf: {{ $getReference }}</li> --}}
                    <li>Date: {{ $getCreatedAt ? $getCreatedAt->format('d-M-Y') : '' }}</li>
                    <li>Type: <span class="fw-bold">{{ $getType }}</span></li>
                </ul>
            </div>
        </div>
        <div class="invoice-bills">
            <table class="invoice-bills-table">
                <thead>
                    <tr>
                        <th class="w-small">#</th>
                        <th class="w-designation">Désignation</th> <!-- Ajoutez une classe pour la colonne "Désignation" -->
                        <th class="w-small">Qté</th> <!-- Ajoutez une classe pour les colonnes plus petites -->
                        <th class="w-small">Reste</th> <!-- Ajoutez une classe pour les colonnes plus petites -->
                        <th class="w-price">Prix U</th> <!-- Ajoutez une classe pour les colonnes plus petites -->
                    </tr>
                </thead>
                <tbody>
                    @php
                    $prixTotal = 0;
                    @endphp
                    @foreach($checkedProducts as $product)
                    @php
                    $resteQte = $product->stock->max_quantity - $product->quantity;
                    $enterQte = $resteQte + $product->quantity;
                    $prixUnity = $product->stock->price_u;
                    $prixTotal += $prixUnity;
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $product->stock->name }}</td>
                        <td>
                            @if($product->type === 'entree')
                            <span class="text-success">+{{ $product->quantity }}</span>
                            @else
                            <span class="text-danger">-{{ $product->quantity }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->type === 'entree')
                            {{ $enterQte }}/<span class="text-muted">{{ $product->stock->max_quantity
                                }}</span>
                            @else
                            {{ $resteQte }}/<span class="text-muted">{{ $product->stock->max_quantity
                                }}</span>
                            @endif
                        </td>
                        <td>{{ $prixUnity }} Ar</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="invoice-total">
                <span>Total :</span>
                <span>{{ number_format($prixTotal, 2) }} Ar</span>
            </div>
            <div class="invoice-notes">
                La somme est arrêtée : {{ $TotalWords }} ariary
            </div>
        </div>
    </div>
    <script>
        // Fonction pour masquer le bouton après avoir généré le PDF
            function masquerBoutonPDF() {
                var boutonPDF = document.getElementById("pdfButton");
                boutonPDF.style.display = "none";
            }
    </script>
</body>
</html>


{{-- <div class="container-fluid">
   <div class="nk-content-inner">
        <div class="nk-content-body">
            @if(count($checkedProducts) > 0)
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="border p-3">
                            <h6 class="text-center mb-0">Bon d'achat ({{$getType}})</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p>Designation</p>
                                </div>
                                <div>
                                    <p>Prix U</p>
                                </div>
                            </div>
                            <ul class="list-group">
                                @php
                                $prixTotal = 0;
                                @endphp
                                @foreach($checkedProducts as $product)
                                @php
                                $resteQte = $product->stock->max_quantity - $product->quantity;
                                $enterQte = $resteQte + $product->quantity;
                                $prixUnity = $product->stock->price_u;
                                $prixTotal += $prixUnity;
                                @endphp
                                <li class="list-group-item d-flex justify-content-between lh-sm"
                                    style="line-height: 0.3!important;">
                                    <div>
                                        <span class="my-0">{{ $product->stock->name }}</span>
                                        @if($product->type === 'entree')
                                        <small class="text-body-secondary">(+{{ $product->quantity }})</small>
                                        @else
                                        <small class="text-body-secondary">(-{{ $product->quantity }})</small>
                                        @endif
                                    </div>
                                    <span class="text-body-secondary">{{ $prixUnity }}Ar</span>
                                </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between lh-sm"
                                    style="line-height: 0.3!important;">
                                    <strong>Total</strong>
                                    <strong>{{ number_format($prixTotal, 2) }} Ar</strong>
                                </li>
                            </ul>
                            <button class="btn btn-icon btn-sm btn-white btn-dim btn-outline-danger mt-3"
                                wire:click.prevent="generatePDF()">
                                <em class="icon ni ni-file-pdf"></em>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <p class="text-danger">Aucun produit sélectionné.</p>
        @endif
    </div>
</div> --}}