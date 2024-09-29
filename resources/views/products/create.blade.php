@extends('layouts.app')
@section('title', 'Create Product')
@section('meta')
    <meta name="description" content="Create a new product in our inventory management system. Fill out the product form with details such as name, description, price, and stock.">
    <meta name="keywords" content="Create Product, Inventory Management, Product Form">
@endsection
@section('content')
    <div class="container">
        <h1>Create Product</h1>

        <div id="surveyContainer"></div>

        <form id="productForm" method="POST" action="{{ route('products.store') }}">
            @csrf
            <input type="hidden" id="productData" name="productData">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
        const surveyJSON = {
            title: "Product Form",
            elements: [{
                    name: "name",
                    type: "text",
                    title: "Product Name",
                    isRequired: true
                },
                {
                    name: "description",
                    type: "comment",
                    title: "Description"
                },
                {
                    name: "price",
                    type: "text",
                    inputType: "number",
                    title: "Price",
                    isRequired: true
                },
                {
                    name: "stock",
                    type: "text",
                    inputType: "number",
                    title: "Stock",
                    isRequired: true
                }
            ]
        };

        document.addEventListener("DOMContentLoaded", function() {
            const survey = new Survey.Model(surveyJSON);
            survey.render(document.getElementById("surveyContainer"));

            // Move onComplete event listener here
            survey.onComplete.add(function(result) {
                document.getElementById("productData").value = JSON.stringify(result.data);
            });
        });
    </script>

    <!-- JSON-LD for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Example Product",
        "description": "Product description goes here",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "USD",
            "price": "29.99"
        }
    }
    </script>
@endsection
