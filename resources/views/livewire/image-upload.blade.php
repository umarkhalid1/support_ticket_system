<div x-data="imageUploader" class="space-y-6">
    <!-- Upload Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Upload Images</h2>

        <!-- Upload Button -->
        <div class="mb-4">
            <button @click="$refs.fileInput.click()"
                class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                    </path>
                </svg>
                Choose Multiple Images
            </button>

            <!-- This input allows multiple image selection -->
            <input type="file" 
                   x-ref="fileInput" 
                   @change="handleFileSelection" 
                   multiple 
                   accept="image/*"
                   class="hidden">
        </div>
        
        <!-- Instructions -->
        <div class="mb-4 text-sm text-gray-600 bg-blue-50 p-3 rounded-lg">
            <p><strong>💡 Tip:</strong> You can select multiple images at once:</p>
            <ul class="mt-1 ml-4 list-disc">
                <li><strong>Windows/Linux:</strong> Hold <kbd class="px-1 py-0.5 bg-gray-200 rounded text-xs">Ctrl</kbd> and click each image</li>
                <li><strong>Mac:</strong> Hold <kbd class="px-1 py-0.5 bg-gray-200 rounded text-xs">Cmd</kbd> and click each image</li>
                <li><strong>Select All:</strong> Press <kbd class="px-1 py-0.5 bg-gray-200 rounded text-xs">Ctrl+A</kbd> (or <kbd class="px-1 py-0.5 bg-gray-200 rounded text-xs">Cmd+A</kbd>) in the file dialog</li>
            </ul>
        </div>

        <!-- Drag and Drop Area -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors"
            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop"
            :class="{ 'border-blue-400 bg-blue-50': dragOver }">

            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>

            <p class="text-lg text-gray-600 mb-2">
                <span class="font-medium">Click to upload</span> or drag and drop images here
            </p>
            <p class="text-sm text-gray-500">PNG, JPG, GIF files are supported</p>
        </div>

        <!-- File Count Info -->
        <div x-show="images.length > 0" class="mt-4 text-sm text-gray-600">
            <span x-text="images.length"></span> image(s) selected
        </div>
    </div>

    <!-- Image Previews -->
    <div x-show="images.length > 0" class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">
                Image Previews (<span x-text="images.length"></span> images)
            </h3>
            <div class="space-x-2">
                <button @click="clearAll"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200">
                    Clear All
                </button>
                <button @click="uploadImages"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-200">
                    Upload All
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <template x-for="(image, index) in images" :key="index">
                <div
                    class="relative group bg-gray-50 rounded-lg overflow-hidden border hover:shadow-lg transition-shadow duration-200">

                    <!-- Image Preview -->
                    <div class="aspect-square">
                        <img :src="image.url" :alt="image.name" class="w-full h-full object-cover">
                    </div>

                    <!-- Remove Button -->
                    <button @click="removeImage(index)"
                        class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Image Details -->
                    <div class="p-3 bg-white">
                        <p class="text-sm font-medium text-gray-800 truncate" x-text="image.name"></p>
                        <p class="text-xs text-gray-500" x-text="formatFileSize(image.size)"></p>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Empty State -->
    <div x-show="images.length === 0" class="text-center py-12">
        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
        </svg>
        <p class="mt-4 text-lg text-gray-500">No images selected</p>
        <p class="text-sm text-gray-400">Choose some images to see them here</p>
    </div>
</div>

@script
<script>
    Alpine.data('imageUploader', () => ({
        images: [],
        dragOver: false,

        handleFileSelection(event) {
            const files = Array.from(event.target.files);
            this.addFiles(files);
        },

        handleDrop(event) {
            this.dragOver = false;
            const files = Array.from(event.dataTransfer.files);
            this.addFiles(files);
        },

        addFiles(files) {
            // Filter only image files
            const imageFiles = files.filter(file => file.type.startsWith('image/'));
            
            imageFiles.forEach(file => {
                // Check if file already exists
                const exists = this.images.some(img => 
                    img.name === file.name && img.size === file.size
                );
                
                if (!exists) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.images.push({
                            file: file,
                            name: file.name,
                            size: file.size,
                            url: e.target.result,
                            id: Date.now() + Math.random()
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Reset file input
            this.$refs.fileInput.value = '';
        },

        removeImage(index) {
            this.images.splice(index, 1);
        },

        clearAll() {
            this.images = [];
        },

        uploadImages() {
            if (this.images.length === 0) {
                alert('Please select some images first!');
                return;
            }

            // Here you can integrate with Livewire
            // Example: this.$wire.uploadImages(this.images.map(img => img.file));
            
            // For demo purposes, we'll just show an alert
            alert(`Ready to upload ${this.images.length} image(s)!\n\nIn a real application, this would send the files to your server.`);
            
            // You can access the actual files like this:
            console.log('Files to upload:', this.images.map(img => img.file));
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }));
</script>
@endscript