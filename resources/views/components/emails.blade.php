<table class="table">
<thead>
    <tr>
    <th scope="col">Дата/час</th>
    <th scope="col">От</th>
    <th scope="col">Относно</th>
    <th scope="col">Билет</th>
    <th scope="col">Статус</th>
    <th scope="col">Оператор</th>
    <th scope="col">Действие</th>
    </tr>
</thead>
<tbody>
@foreach ($emails as $email)
    <tr 
        @switch($email->status)
            @case(0)
                class="text-danger"
                @break
            @case(1)
                class="text-warning"
                @break
            @case(2)
                class="text-success"
                @break
            @default
            class="text-info"
        @endswitch
    >
    <td class="text-center">{{ $email->created_at }}</td>
    <td class="text-center">{{ $email->from }}</td>
    <td class="text-center">{{ substr($email->subject, strpos($email->subject, "[TICKET:") + 19) }}</td>
    <td class="text-center">{{ substr($email->subject, 1, 17) }}</td>
    @switch($email->status)
        @case(0)
            <td class="text-center text-danger">Получен</td>
            @break
        @case(1)
            <td class="text-center">Назначен е оператор</td>
            @break
        @case(2)
            <td class="text-center">Билета е затворен</td>
            @break
        @default
        <td class="text-center">В момента се обработва</td>
    @endswitch
    <td class="text-center">{{ ($email->user->name == "Admin") ? "Няма" : $email->user->name  }}</td>
    <td class="text-center flex"><a  class="padding15 text-danger" onclick="return confirm('Моля потвърдете изтриването')" href="{{  url("/dashboard/delete/{$email->id}") }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></a><a class="padding15" href="{{  url("/dashboard/edit/{$email->id}") }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a></td>
    </tr>
@endforeach
</tbody>
</table>
