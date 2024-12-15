<div class="pb-4">
    <nav aria-label="Steps" class="bg-white">
        <ol role="list" class="divide-gray-300 rounded-md border border-gray-300 grid grid-cols-4">

            @foreach($steps as $key => $step)
            
            <li class="relative md:flex md:flex-1 rounded-l-md {{$loop->last?'':'border-r'}} border-gray-300 {{$step->isPrevious()? 'bg-green-50':''}} {{$step->isCurrent()?'ring-2 rounded ring-sky-800':''}}">
                
                <a class="group w-full flex items-center {{$step->isPrevious() || $step->isCurrent() ? 'cursor-pointer' : 'cursor-not-allowed'}}"
                    
                    @if($loop->first) wire:click="forgetState" @endif
                    
                    @if(!$loop->first && $step->isPrevious()) wire:click="{{ $step->show() }}" @endif
                    
                    {{$step->isPrevious() ? 'x-description="Completed Step"' : '' }}
                    
                    {{$step->isCurrent() ? 'aria-current="step" x-description="Current Step"' : '' }}
                    
                    {{$step->isNext() ? 'x-description="Upcoming Step"' : '' }}
                    
                    >
                    <span class="flex grow items-center lg:px-4 px-2 py-4 text-sm font-medium">
                        
                        {{-- the commented out span-element is a circle around the icon --}}
                        {{-- <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full
                            {{$step->isCurrent() ? 'border-2 border-sky-800' : ($step->isPrevious() ? 'bg-green-400 group-hover:bg-green-600' : 'border-2 border-gray-300 group-hover:border-gray-400')}}"> --}}

                            @if ($step->isPrevious())
                                
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 grow md:grow-0 {{$step->isCurrent() ? 'text-sky-800' : ($step->isPrevious() ? 'text-green-600' : 'text-gray-300 group-hover:text-gray-400')}}">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                                  
                            @else

                                <svg viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 grow md:grow-0 {{$step->isCurrent() ? 'text-sky-800' : ($step->isPrevious() ? 'text-green-600' : 'text-gray-300 group-hover:text-gray-400')}}">
                                    {!! $step->icon !!}
                                </svg>

                            @endif
                        
                        {{-- </span> --}}

                        <span class="ml-2 text-sm font-medium {{$step->isCurrent() ? 'text-sky-800' : ($step->isPrevious()?'text-green-800':'text-gray-300 group-hover:text-gray-400') }} hidden md:block">
                            {{ $step->label }}
                        </span>
                    </span>
                </a>
                    
                {{-- @if (!$loop->last)
                <!-- Arrow separator for lg screens and up -->
                <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
                    <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"></path>
                    </svg>
                </div>    
                @endif --}}
            </li>
            @endforeach
                
                {{-- <li class="relative md:flex md:flex-1">
                    
                    <a href="#" class="group flex w-full items-center" x-description="Completed Step">
                        <span class="flex items-center px-6 py-4 text-sm font-medium">
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-sky-800 group-hover:bg-sky-800">
                                <svg class="h-6 w-6 text-white" x-description="Heroicon name: solid/check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-900">Job details</span>
                        </span>
                    </a>
                    
                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </li>
                <li class="relative md:flex md:flex-1">
                    
                    <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step" x-description="Current Step">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-sky-800">
                            <span class="text-sky-800">02</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-sky-800">Application form</span>
                    </a>
                    
                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </li>
                <li class="relative md:flex md:flex-1">
                    <a href="#" class="group flex items-center" x-description="Upcoming Step">
                        <span class="flex items-center px-6 py-4 text-sm font-medium">
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                <span class="text-gray-500 group-hover:text-gray-900">03</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Preview</span>
                        </span>
                    </a>
                </li> --}}
                
            </ol>
        </nav>
        
    </div>