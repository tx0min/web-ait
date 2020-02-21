<div id="messages">

    @if ($errors->any())
        <div class="alert alert-danger">
           
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        
        </div>
    @endif


    @if (session('success') || session('error') || session('info'))
    
       
    
    
        @if (session('success'))
            
            <div class="alert alert-success">
               @if(is_array(session('success')) || is_object(session('success')))
                   <pre>{{ var_dump(session('success')) }}</pre>
               @else
                    {!! session('success') !!}
               @endif
            </div>
    
    
        @endif
    
    
        @if (session('error'))
            <div class="alert alert-danger">
                @if(is_array(session('error')) || is_object(session('error')))
                       <pre>{{ var_dump(session('error')) }}</pre>
               @else
                       {!! session('error') !!}
               @endif
            </div>
    
    
            
        @endif
    
    
        @if (session('info'))
            <div class="alert alert-info">
               @if(is_array(session('info')) || is_object(session('info')))
                       <pre>{{ var_dump(session('info')) }}</pre>
               @else
                       {!! session('info') !!}
               @endif
            </div>
    
        @endif
    @endif
    </div>