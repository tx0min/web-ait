<div id="messages">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
           
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <small aria-hidden="true">@icon('times')</small>
            </button> 
        </div>
    @endif


    @if (session('success') || session('error') || session('info'))
    
       
    
    
        @if (session('success'))
            
            <div class="alert alert-success alert-dismissible">
               @if(is_array(session('success')) || is_object(session('success')))
                   <pre>{{ var_dump(session('success')) }}</pre>
               @else
                    {!! session('success') !!}
               @endif
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <small aria-hidden="true">@icon('times')</small>
              </button>   
            </div>
    
    
        @endif
    
    
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                @if(is_array(session('error')) || is_object(session('error')))
                       <pre>{{ var_dump(session('error')) }}</pre>
               @else
                       {!! session('error') !!}
               @endif
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <small aria-hidden="true">@icon('times')</small>
              </button>
            </div>
    
    
            
        @endif
    
    
        @if (session('info'))
            <div class="alert alert-info alert-dismissible">
               @if(is_array(session('info')) || is_object(session('info')))
                       <pre>{{ var_dump(session('info')) }}</pre>
               @else
                       {!! session('info') !!}
               @endif
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <small aria-hidden="true">@icon('times')</small>
              </button>
            </div>
    
        @endif
    @endif
    </div>