<div
    class="w-64 h-64 border-4 border-gray-300 border-dashed rounded bg-white"
    x-data="{
        isUploading: false,
        progress: 0,
        circumference: 60 * 2 * Math.PI
    }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    @if ($file)
        <img src="{{ $file->temporaryUrl() }}" class="w-full h-full rounded object-cover">
    @else
        <label
            for="upload"
            x-show="!isUploading"
            class="w-full h-full flex flex-col items-center justify-center cursor-pointer transition duration-300 ease-in-out hover:bg-gray-100"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 animate-bounce text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <p class="text-gray-400 font-bold">
                Upload
            </p>
        </label>
    @endif

    <div
        x-show="isUploading"
        x-cloak
        class="flex flex-col w-full h-full justify-center items-center"
    >
        <div class="absolute items-center justify-center overflow-hidden rounded-full">
            <svg class="w-40 h-40">
            <circle class="text-gray-300"
                stroke-width="6"
                stroke="currentColor"
                fill="transparent"
                r="60"
                cx="80"
                cy="80"
            />
            <circle
                class="text-gray-500"
                stroke-width="6"
                :stroke-dasharray="circumference"
                :stroke-dashoffset="circumference - progress / 100 * circumference"
                stroke-linecap="round"
                stroke="currentColor"
                fill="transparent"
                r="60"
                cx="80"
                cy="80"
            />
            </svg>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        <p class="text-gray-300" x-html="progress + '%'"></p>
    </div>

    <input
        onchange="validation(event)"
        wire:model="file"
        type="file"
        name="upload"
        id="upload"
        class="hidden"
    />

    <script>
        function validation(event)
        {
            console.log(event.target.files[0]);

            // Prevent Livewire events if filesize is larger than 1MB.
            if(event.target.files[0].size >= 1024000) {
                alert("File size tidak boleh melebihi 1MB");
                return event.stopImmediatePropagation();
            }

            // Prevent Livewire events if mimetypes is not in theese type:
            switch (event.target.files[0].type) {
                // Images
                case "image/jpeg":
                case "image/jpg":
                case "image/png":
                // Documents
                case "application/msword":
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                // Spreadsheets
                case "application/vnd.ms-excel":
                case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                // Presentations
                case "application/vnd.ms-powerpoint":
                case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                // PDFs
                case "application/pdf":
                    return false;
                    break;

                default:
                    alert("Ekstensi yang diperbolehkan adalah .jpg, .jpeg, .png, .doc(x), .xls(x), .ppt(x), .pdf");
                    return event.stopImmediatePropagation();
                    break;
            }
        }
    </script>
</div>