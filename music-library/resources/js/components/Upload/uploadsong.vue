<template>
    <div class="w-[640px] sm:w-screen select-none">
        <!-- <div class="text-white"> {{user.name}}</div> -->
        <div id='upload'
            class="pt-[40px] bg-gradient-to-r from-gray-100 to-gray-100 dark:bg-gradient-to-r dark:from-neutral-900 dark:to-neutral-900  w-min-[375px]   ">
            <div class="flex items-center -mt-[40px] justify-center h-screen flex-wrap text-white">

                <div v-if="uploadMessage == 'successful'"
                    class="bg-gray-200  dark:bg-neutral-800  relative  p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 w-[300px] h-[510px] sm:w-[350px] sm:h-[510px] md:w-[450px] md:h-[530px] lg:w-[550px] lg:h-[550px] xl:w-[600px] xl:h-[600px] 2xl:w-[650px] 2xl:h-[650px] ">
                    <uploadsong-info :received-file="file" :received-Userid="userid"> </uploadsong-info>
                </div>

                <div v-else
                    class=" bg-gray-200  dark:bg-neutral-800  p-8 rounded-lg sm:rounded-lg shadow-lg hover:shadow-xl transition duration-300 w-min sm:w-[350px]  md:w-[450px] lg:w-[550px]  xl:w-[600px] 2xl:w-[650px] h-[510px] sm:h-[510px] md:h-[530px] lg:h-[550px] xl:h-[600px]  2xl:h-[650px]">
                    <h2 class="select-none text-lg font-semibold my-4 text-neutral-800 dark:text-neutral-50 bg-transparent">Upload
                        Music</h2>
                    <div
                        class="grid gap-2 justify-items-center content-between bg-transparent my-[20px] sm:my-[30px] md:my-[30px] lg:my-[60px] xl:my-[100px] 2xl:my-[100px]">


                        <div class="">
                            <input type="file" ref="fileInput" style="display: none" @change="uploadFile"
                                name="fileinputname">
                            <button @click="openFileInput"
                                class=" text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 414 414"
                                    class="fill-gray-800 hover:fill-gray-700  dark:fill-neutral-200 dark:hover:fill-gray-300 h-[90px] sm:h-[100px] md:h-[150px] lg:h-[150px] xl:h-[150px] 2xl:h-[150px]">
                                    <path class="cls-1"
                                        d="m207,0C92.68,0,0,92.68,0,207s92.68,207,207,207,207-92.68,207-207S321.32,0,207,0Zm0,141.22l49.88,49.88h-32.86v49.06h-34.03v-49.06h-32.86l49.88-49.88Zm50,131.56h-100v-20h100v20Z" />
                                </svg>
                            </button>
                        </div>

                        <div class="my-2 sm:my-4">
                            <div class="text-gray-600 dark:text-neutral-50 mb-6 text-center font-semibold">Drag and drop
                                music files to upload </div>
                            <div class="text-gray-600 dark:text-neutral-300 mb-6 text-center">Your music will be private
                                until you publish them.</div>
                        </div>
                        <div class="">
                            <input type="file" ref="fileInput" style="display: none" @change="uploadFile"
                                name="fileinputname">
                            <button @click="openFileInput"
                                class="bg-gray-800 hover:bg-gray-700 dark:bg-neutral-200 dark:hover:bg-gray-300 text-neutral-50 dark:text-neutral-900 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                                <p>Select Files</p>
                            </button>
                        </div>
                        <p class="absolute bottom-0 text-transparent select-none  ">Select Files</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UploadSongInfo from './uploadsonginfo.vue';
import axios from 'axios';

export default {
    components: {
        'uploadsong-info': UploadSongInfo
    },

    props: {
        app: {
            type: Object
        },
        user: {
            type: Object
        }
    },

    data() {
        return {
            uploadMessage: '',
            filename: '',
            file: File,
        };
    },
    methods: {

        
        openFileInput() {
            this.$refs.fileInput.click();
        },


        uploadFile(event) {
            this.file = event.target.files[0];
            const formData = new FormData();
            formData.append('file', this.file);

            axios.post('/upload-song-validation', formData)
                .then(response => {
                    this.userid = this.user.id
                    this.uploadMessage = response.data.message;
                    if(this.uploadMessage == 'successful'){
                        console.log(response.data.message);
                        this.filename = response.data.filename;
                    }
                    else{
                        alert(response.data.message);
                    }

                })
                .catch(error => {
                    // Handle errors, e.g., show an error message to the user
                    // console.error(error);
                    this.uploadMessage = response.data.message; // Set an error message if the upload fails
                });
        }
    }
};
</script>
