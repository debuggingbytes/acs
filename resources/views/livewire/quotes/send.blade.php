<div class="p-2">
    <span class="text-2xl text-cyan-700 font-bold">Make a quote</span>
    <div class="flex gap-4 w-full">
        <div id="quote-logo">
            <img src="{{ asset('img/acs-logo-new.webp')}}" alt="logo" class="w-120">
        </div>
        <div id="prepared-by" class="flex gap-2 w-1/4 border flex-col justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Prepared by:</span>
                <span>NAME</span>
            </div>
            <div class="flex">
                <span class="font-bold">Alberta Crane Service Ltd.</span>
            </div>
            <div class="flex">
                <span class="font-bold">Edmonton, AB, T6X0T8, Canada</span>
            </div>
            <div class="flex flex-col">
                <span>email@albertacraneservice.com</span>
            </div>
            <div class="flex flex-col">
                <span>1-780-803-2302</span>
            </div>
        </div>
        <div id="prepared-for" class="flex gap-2 w-1/4 border flex-col justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Prepared For:</span>
                <span>NAME</span>
            </div>
            <div class="flex">
                <span class="font-bold">COMPANY NAME</span>
            </div>
            <div class="flex">
                <span class="font-bold">LOCATION</span>
            </div>
            <div class="flex flex-col">
                <span>CLIENT EMAIL</span>
            </div>
            <div class="flex flex-col">
                <span>CLIENT PHONE</span>
            </div>
        </div>
        <div id="additional-info" class="flex flex-col w-1/4 border justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Created On:</span>
                <span>DATE</span>
            </div>
            <div class="flex flex-col w-full">
                <span class="font-bold">Total Price:</span>
                <span class="flex justify-center items-center w-5/6 h-12 mx-auto my-1 border-2 border-black text-2xl">
                    $1,000,000
                </span>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Currency Type:</span>
                <span class="flex justify-center items-center w-5/6 h-12 mx-auto my-1 border-2 border-black text-2xl">
                    U.S Dollars
                </span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-7 text-center border-2 gap-4 my-20 p-2">
        {{-- Headers --}}
        <div class="flex flex-col col-span-2 h-12">
            <span class="font-bold">ITEM</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUANTITY</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUOTED PRICED</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LIST PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">SHIPPING PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LINE ITEM TOTAL</span>
        </div>
        {{-- Cells --}}
        <div class="flex flex-col col-span-2">
            <span class="font-bold">Crane Name</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
    </div>
</div>
