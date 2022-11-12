<div class='h-screen flex flex-col justify-center items-center bg-blue-300'>
    <div class='flex items-center'>
        <div class='w-80  bg-gray-300 p-6 rounded-lg md:bg-blue-200 md:w-90'> 
            <div class='mb-3'>
                <label for='sel_name' class='mb-2 text-md font-medium test-grat-900 dark:text-gray-300'>使用者名稱</label>
                <select id="sel_name" class='h-11 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'></select>
            </div>
            <div class='mb-3'>
                <label class='mb-2 text-md font-medium test-grat-900 dark:text-gray-300'>IP</label>
                <div class='flex w-full hover:w-screen'>
                    <input id='ip01' class='w-10 text-center rounded-lg mr-1'>.
                    <input id='ip02' class='w-10 text-center rounded-lg mx-1'>.
                    <input id='ip03' class='w-10 text-center rounded-lg mx-1'>.
                    <input id='ip04' class='w-10 text-center rounded-lg ml-1'>
                </div>
            </div>
            <div class='mb-3'>
                <label for='sel_category' class='mb-2 text-md font-medium test-grat-900 dark:text-gray-300'>類別</label>
                <select id="sel_category" class='h-11 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'>
                    <option>remote</option>
                    <option>local</option>
                </select>
            </div>
            <div class='flex justify-center'>
                <button id='submit' class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        ENTER
                    </span>
                </button>
            </div>
        </div>
        <div class='w-50  bg-gray-300 p-6 rounded-lg md:bg-blue-200 md:w-90 ml-10 flex flex-col items-center'>         
            <div>新增使用者名稱</div>
            <input id='input_add_uname' class='mb-3 mt-1 text-center'>
            <button id='btn_add_uname' class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    新增
                </span>
            </button>
        </div>
    </div>
    <div id='show_data' class='flex justify-center mt-10 hidden'>
        <div class='w-100  bg-gray-300 p-6 rounded-lg md:bg-blue-200 md:w-90 ml-10'>         
            <div id='show'></div>
            <input id='input_show'>
            <div class='flex justify-center'>
                <button id='btn_copy' class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    複製
                    </span>
                </button>
            </div>
        </div>
        
    </div>
</div>