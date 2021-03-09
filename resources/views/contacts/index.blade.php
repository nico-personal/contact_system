<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contacts
        </h2>
    </x-slot>

    <div class="py-12 contact_list">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <input type='text' id="search" placeholder="Search">
                <a class="btn btn-success" href="{{ route('contacts.create') }}"> Add Contact</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" id='data'>
        <tr>
            <th>Name</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        <tbody >
            @foreach ($data as $key => $value)
            <tr >
                <td>{{ $value->name }}</td>
                <td>{{ $value->company }}</td>
                <td>{{ $value->mobile }}</td>
                <td>{{ $value->email }}</td>
                <td>
                    <form action="{{ route('contacts.destroy',$value->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('contacts.edit',$value->id) }}">Edit</a>   
                        @csrf
                        @method('DELETE')      
                        <button type="submit" class="btn btn-danger delete">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>  
    {!! $data->links() !!}      
    <script type="text/javascript">
    $('.delete').click(function(){
    if( confirm('Do you really want to delete this contact?')) {

    }else{
        return false;
    }
})
        $('#search').on('keyup',function(){
            $value=$(this).val();
            console.log($value);
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value},
                success:function(data){
                    text='<tr>';
                    text += '<th>Name</th>';
                    text += '<th>Company</th>';
                    text += '<th>Phone</th>';
                    text += '<th>Email</th>';
                    text += '<th width="280px">Action</th>';
                    text += '</tr>';
               for (i = 0; i < data.length; i++) {
                    text += '<tr>';
                    text += '<td>'+ data[i]['name'] + "</td>";
                    text += '<td>'+ data[i]['company'] + "</td>";
                    text += '<td>'+ data[i]['mobile'] + "</td>";
                    text += '<td>'+ data[i]['email'] + "</td>";
                    text +='<td>'+ "<form action='{{ route('contacts.destroy',$value->id) }}' method='POST'> ";
                    text += "<a class='btn btn-primary' href='{{ route('contacts.edit',$value->id) }}'>Edit</a>";
                    text += '@csrf @method("DELETE") <button type="submit" class="btn btn-danger">Delete</button></form></td>';
                    text += '</tr>';
                }
                $('#data').html(text);
                $('.contact_list nav').remove();
            }
            });
        })
    </script>
    </script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

            </div>
        </div>
    </div>
</x-app-layout>
