<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-3xl py-8 sm:px-6 md:px-8">
            
            <div class="flow-root overflow-hidden bg-white shadow rounded-lg">
                <!-- Head -->
                <div class="bg-gray-50 border-b border-gray-200 px-4 py-5 sm:px-6">
                    <h1 class="text-xl font-bold leading-5 text-gray-900">Succesvol gereserveerd!</h1>
                </div>
                
                <!-- Content -->
                <div class="p-4 md:pt-6">                        
                    <div class="pt-4 mt-4 pl-0 border-t border-gray-300 md:border-t-0 md:pl-4 md:pt-0 md:mt-0">                          
                        <div class="bg-gray-100">
                            <div class="bg-white p-6  md:mx-auto">
                              <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                                  <path fill="currentColor"
                                      d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                                  </path>
                              </svg>
                              <div class="text-center">
                                  <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Succesvol gereserveerd!</h3>
                                  <p class="text-gray-800 my-2">Bedankt dat u voor ons hebt gekozen!</p>
                                  <p> Nog een fijne dag verder en tot ziens!  </p>
                                  <div class="text-gray-800 py-10 text-center">
                                      <a href="{{route('welcome')}}" class="px-12 bg-sky-600 hover:bg-sky-500 text-white font-semibold py-3">
                                          Terug naar home 
                                     </a>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>