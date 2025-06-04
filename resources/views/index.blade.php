<h3>Danh thu theo năm</h3>
<form method="get" action="{{ route('index') }}">
    <select name="Loc" class="form-select" aria-label="Default select example">
        @php
            $currentYear = date('Y');
        @endphp

        @for ($i = $currentYear; $i >= 2020; $i--)
            <option {{ request('Loc') == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor

    </select>
    <button type="submit">LOC</button>
</form>

<table class="table" border="1">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">THÁNG</th>
      <th scope="col">DOANH THU</th>
      <th scope="col">NGÀY THU NHIỀU NHẤT</th>
      <th scope="col">NGÀY THU ÍT NHẤT</th>
    </tr>
  </thead>
  <tbody>

       @foreach ( $revenue_datas as $key => $value )

        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$value->date}}</td>
            <td>{{$value->revenue}}</td>
            @if ($key==0)
            <td>{{$max_revenue->date}}</td>

            @endif
            @if ($key==0)
            <td>{{$min_revenue->date}}</td>
            @endif

        </tr>
       @endforeach




  </tbody>
</table>
