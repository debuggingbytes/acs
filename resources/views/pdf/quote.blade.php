<!DOCTYPE html>
<html>

<head>
    <title>Quote</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* Base settings */
        @page {
            size: letter;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            width: 8.5in;
            margin: 0 auto;
            background: white;
            font-size: 10pt;
            line-height: 1.3;
            font-family: Arial, sans-serif;
        }

        /* Quote container */
        .quote-container {
            padding: 0.125in;
        }

        /* Header section */
        .quote-number {
            padding: 0.1in;
            text-align: right;
            font-size: 9pt;
            font-weight: bold;
        }

        .header-grid {
            display: table;
            /* Changed to table */
            width: 100%;
            border-collapse: collapse;
            /* Collapse table borders */
            margin-bottom: 0.25in;
        }

        .header-grid-row {
            display: table-row;
        }

        .header-grid-cell {
            display: table-cell;
            vertical-align: top;
            /* Align cells to top */
            padding: 0.05in;
            /* Add padding to cells */
        }

        #quote-logo img {
            max-width: 1.5in;
            height: auto;
        }

        .info-section {
            width: 100%;
            padding: 0.1in;
            /* Add padding to the info sections */
        }

        /* Price display */
        .price-box {
            border: 1pt solid black;
            padding: 0.05in;
            text-align: center;
            margin: 0.05in auto;
            width: 80%;
            font-size: 10pt;
        }

        /* Items grid */
        .items-grid {
            display: table;
            /* Changed to table */
            width: 100%;
            border-collapse: collapse;
            /* Collapse table borders */
            margin: 0.05in 0;
            border: 1pt solid black;
        }

        .items-grid-row {
            display: table-row;
        }

        .items-grid-cell {
            display: table-cell;
            padding: 0.05in;
            text-align: center;
        }

        .grid-header {
            font-weight: bold;
            padding: 0.05in;
        }

        /* Images section */
        .images-container {
    width: 100%; /* Or adjust as needed */
    border-collapse: collapse;
}

.images-container td {
    vertical-align: top; /* Align images to the top of the cells */
    padding: 0.15in; /* Add padding if needed */
}

.main-image {
    width: auto; /* Let image determine its size */
    text-align: center; /* Center the main image */
}

.main-image img {
    max-width: 3.5in; /* Or adjust as needed */
    height: 3.5in;
    object-fit: cover;
}

.thumbnail-grid {
    width: auto;
    border-collapse: collapse; /* Collapse borders for the thumbnail grid */
}

.thumbnail-grid td {
    width: 50%; /* Each thumbnail takes 50% of the thumbnail grid's width */
    padding: 0.05in; /* Add padding to the cells */
    text-align: center; /* Center the thumbnails within the cells */
}

.thumbnail-grid img {
    max-width: 100%;
    height: auto;
    object-fit: cover; /* or contain, depending on how you want the images to fit */
}

        /* Specifications */
        .specs-container {
            width: 95%;
            margin: 0.25in auto;
        }

        .spec-row {
            display: flex;
            gap: 0.1in;
            margin-bottom: 0.1in;
        }

        .spec-label {
            width: 33%;
            background-color: #e5e5e5;
            padding: 0.05in;
            font-weight: bold;
        }

        .spec-value {
            padding: 0.05in;
        }

        /* View on Web button */
        .web-button {
            background-color: #0e7490;
            color: white;
            padding: 0.1in;
            border-radius: 0.25em;
            text-decoration: none;
            display: inline-block;
        }

        /* Utility classes */
        .font-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-cyan {
            color: #0e7490;
        }

        .mt-20 {
            margin-top: 0.15in;
        }

        .mt-10 {
            margin-top: 0.1in;
        }

        .mt-5 {
            margin-top: 0.075in;
        }

        .w-3\/4 {
            width: 75%;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        /* Print optimizations */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .items-grid,
            .specs-container,
            .images-container {
                page-break-inside: avoid;
            }

            img {
                max-width: 100%;
                page-break-inside: avoid;
            }

            .no-print {
                display: none !important;
            }
        }
        .page-break-before {
    page-break-before: always; /* or auto, avoid, left, right */
}
    </style>
</head>

<body>
    <div class="quote-container">
        <div class="quote-number">
            {{ $quote->quote_number }}
        </div>

        <div class="header-grid">
            <div class="header-grid-row">
                <div class="header-grid-cell" id="quote-logo">
                    <img src="{{ public_path('img/acs-logo-new.webp') }}" alt="logo">
                </div>
                <div class="header-grid-cell">
                    <div class="info-section">
                        <div class="font-bold">Prepared by:</div>
                        <div>{{ Auth::user()->name }}</div>
                        <div class="font-bold">Alberta Crane Service Ltd.</div>
                        <div class="font-bold">Edmonton, AB, T6X0T8, Canada</div>
                        <div>{{ Auth::user()->email }}</div>
                        <div>1-780-803-2302</div>
                    </div>
                </div>
                <div class="header-grid-cell">
                    <div class="info-section">
                        <div class="font-bold">Prepared For:</div>
                        <div>{{ $quote->client_name }}</div>
                        <div class="font-bold">{{ $quote->client_company }}</div>
                        <div class="font-bold">{{ $quote->client_address }}</div>
                        <div>{{ $quote->client_email }}</div>
                        <div>{{ $quote->client_phone }}</div>
                    </div>
                </div>
                <div class="header-grid-cell">
                    <div class="info-section">
                        <div>
                            <div class="font-bold">Created On:</div>
                            <div>{{Carbon\Carbon::today()->format('F j, Y');}}</div>
                        </div>
                        <div>
                            <div class="font-bold">Total Price:</div>
                            <div class="price-box">{{ $quote->price }}</div>
                        </div>
                        <div>
                            <div class="font-bold">Currency Type:</div>
                            <div class="price-box">{{ $quote->currency }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="items-grid">
            <thead>
                <tr>
                    <th class="grid-header" style="width: 1.56in" colspan="2">ITEM</th>
                    <th class="grid-header">QUANTITY</th>
                    <th class="grid-header">QUOTED PRICE</th>
                    <th class="grid-header">LIST PRICE</th>
                    <th class="grid-header">SHIPPING PRICE</th>
                    <th class="grid-header">LINE ITEM TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="width: 1.56in" class="text-center font-bold">LTM 1220</td>
                    <td class="text-center">{{ $quote->quantity }}</td>
                    <td class="text-center">{{ $quote->price }}</td>
                    <td class="text-center">{{ $quote->list_price }}</td>
                    <td class="text-center">{{$quote->shipping_price}}</td>
                    <td class="text-center">{{$quote->line_item}}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-right mt-5" style="display: flex; width: 100%; justify-content: flex-end; text-align: right;">
            <a href="{{ route('download.quote', ['quote' => $quote->id]) }}" class="web-button no-print" style="cursor: pointer; margin-top: 0;">View on Web</a>
        </div>

        <table class="images-container" style="margin-top: 0.375in;">
            <tbody>
                <tr>
                    <td class="main-image">
                        <img src='{{ public_path($quote->inventory->thumbnail) }}' alt="crane" class="rounded shadow" />
                    </td>
                    <td class="thumbnail-grid">
                        <table>
                            <tbody>
                                @php
                                    $imageCount = 0;
                                    $maxCount = min(count($quote->inventory->images), 4);
                                @endphp

                                @foreach ($quote->inventory->images as $image)
                                    @if ($image->image_path != $quote->inventory->thumbnail)
                                        @if ($imageCount < $maxCount)
                                            @if ($imageCount % 2 == 0)  {{-- Start new row for every 2 images --}}
                                                <tr>
                                            @endif

                                            <td class="thumbnail-cell">
                                                <img src="{{ public_path($image->image_path) }}" alt="crane" class="rounded shadow">
                                            </td>

                                            @if ($imageCount % 2 != 0)  {{-- Close row after 2 images --}}
                                                </tr>
                                            @endif

                                            @php
                                                $imageCount++;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="specs-container">
            <thead>
                <tr>
                    <th class="spec-label">Make:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->make }}</td>

                    <th class="spec-label">Model:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->model }}</td>
                </tr>
                <tr>

                    <th class="spec-label">Year:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->year }}</td>
                    <th class="spec-label">Capacity:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->capacity }}</td>
                </tr>
                <tr>

                    <th class="spec-label">Boom:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->boom }}</td>

                    <th class="spec-label">Jib Type:</th>
                    <td class="spec-value">{{ $quote->inventory->craneInventory->jibType }}</td>
                </tr>
                <tr>
                    <th class="spec-label">Hours (Upper/Lower):</th>
                    <td class="spec-value">{{$quote->inventory->craneInventory->hoursUpper}} / {{ $quote->inventory->craneInventory->hoursLower }}</td>
                    <th class="spec-label">Price:</th>
                    <td class="spec-value">{{ $quote->price }}</td>
                </tr>
            </thead>
        </table>


        <div class="header-grid page-break-before">
            <div class="header-grid-row">
                <div class="header-grid-cell" id="quote-logo">
                    <img src="{{ public_path('img/acs-logo-new.webp') }}" alt="logo">
                </div>
                <div class="header-grid-cell quote-number">
                    {{ $quote->quote_number }}
                </div>
            </div>
        </div>
        <div class="w-3/4 mx-auto mt-10">
            @bb(nl2br($quote->inventory->craneInventory->description))
        </div>

        <div class="text-center w-3/4 mx-auto mt-10">
            <p>For more information please contact <span class="font-bold">{{ Auth::user()->name }}</span>, thank you
                for your consideration</p>
        </div>

        <table class="items-grid">
            <thead>
                <tr>
                    <th class="grid-header" style="width: 1.56in" colspan="2">ITEM</th>
                    <th class="grid-header">QUANTITY</th>
                    <th class="grid-header">QUOTED PRICE</th>
                    <th class="grid-header">LIST PRICE</th>
                    <th class="grid-header">SHIPPING PRICE</th>
                    <th class="grid-header">LINE ITEM TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="width: 1.56in" class="text-center font-bold">LTM 1220</td>
                    <td class="text-center">{{ $quote->quantity }}</td>
                    <td class="text-center">{{ $quote->price }}</td>
                    <td class="text-center">{{ $quote->list_price }}</td>
                    <td class="text-center">{{$quote->shipping_price}}</td>
                    <td class="text-center">{{$quote->line_item}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
