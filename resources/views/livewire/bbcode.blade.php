<div class="grid grid-cols-2 gap-2">
    <div class="rounded-xl shadow-xl overflow-hidden">
        <h4 class="uppercase font-bold bg-cyan-700 block p-2">BBCode List</h4>
        <ul class="list-disc pl-5 space-y-2 ml-5">
            <li><strong>Bold Text:</strong> <code class="block px-2">[b]Your text here[/b]</code> - This will make your text bold.</li>
            <li><strong>Italic Text:</strong> <code class="block px-2">[i]Your text here[/i]</code> - This will make your text italic.</li>
            <li><strong>Underlined Text:</strong> <code class="block px-2">[u]Your text here[/u]</code> - This will underline your text.</li>
            <li><strong>Strikethrough Text:</strong> <code class="block px-2">[s]Your text here[/s]</code> - This will strike through your text.</li>
            <li><strong>Text Size:</strong> <code class="block px-2">[size=YourSizeHere]Your text here[/size]</code> - This will change the size of your text.</li>
            <li><strong>Text Color:</strong> <code class="block px-2">[color=YourColorHere]Your text here[/color]</code> - This will change the color of your text.</li>
            <li><strong>Text Alignment:</strong> <code class="block px-2">[center]Your text here[/center]</code>, <code class="block px-2">[left]Your text here[/left]</code>, <code class="block px-2">[right]Your text here[/right]</code> - These will align your text to the center, left, or right.</li>
            <li><strong>Blockquote:</strong> <code class="block px-2">[quote]Your text here[/quote]</code> - This will put your text in a blockquote.</li>
            <li><strong>Link:</strong> <code class="block px-2">[url]YourURLHere[/url]</code>, <code class="block px-2">[url=YourURLHere]Your text here[/url]</code> - These will create a hyperlink.</li>
            <li><strong>Image:</strong> <code class="block px-2">[img]YourImageURLHere[/img]</code> - This will display an image.</li>
            <li><strong>Lists:</strong> <code class="block px-2">[list]Your text here[/list]</code>, <code class="block px-2">[list=1]Your text here[/list]</code>, <code class="block px-2">[list=a]Your text here[/list]</code> - These will create different types of lists.</li>
            <li><strong>List Item:</strong> <code class="block px-2">[*]Your text here</code> - This will create a list item.</li>
            <li><strong>Code:</strong> <code class="block px-2">[code]Your code here[/code]</code> - This will format your text as code.</li>
            <li><strong>YouTube Video:</strong> <code class="block px-2">[youtube]YouTubeVideoID[/youtube]</code> - This will embed a YouTube video.</li>
            <li><strong>Line Break:</strong> Use <code class="block px-2">\r\n</code> to create a line break.</li>
        </ul>
        <p class="mt-2">Note: Replace 'Your text here', 'YourSizeHere', 'YourColorHere', 'YourURLHere', 'YourImageURLHere', and 'YouTubeVideoID' with your actual content.</p>
    </div>

    <div class="rounded-xl shadow-xl overflow-hidden">
        <h4 class="uppercase font-bold bg-cyan-700 block p-2">BBCode Preview</h4>

        <p class="text-md p-2">
            Below you can see how BBCode behaves within the browsesr.
            <textarea wire:model.live='bbcode' class="h-32 w-full block mt-2 p-1"></textarea>
        </p>
        <p class="block p-1">
            @if (!empty($bbcode))
                @bb(nl2br($bbcode))
            @endif
        </p>
    </div>
</div>
