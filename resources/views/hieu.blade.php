<h3>Danh thu theo năm</h3>
<form method="get" action="{{route('hieu')}}">
    <select name="nam">
        @php
            $namhientai = date('Y');
        @endphp
        @for ($i=$namhientai; $i>=2020; $i--)
            <option {{ request('nam') == $i ? 'selected' : '' }}>{{$i}}</option>
        @endfor
    </select>
        <button type="sybmit">SUBMIT</button>


</form>

<table   border="1">
    <thead  >
        <tr>
            <th>Tháng</th>
            <th>Tổng doanh thu</th>
            <th>Ngày thấp nhất</th>
            <th>Doanh thu thấp nhất</th>
            <th>Ngày cao nhất</th>
            <th>Doanh thu cao nhất</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datathang as $data)
        <tr>
            <td>{{ $data->thang }}</td>
            <td>{{ $data->doanhthu }}</td>
            <td>{{ $data->ngay_min }}</td>
            <td>{{ $data->doanhthu_min}}</td>
            <td>{{ $data->ngay_max }}</td>
            <td>{{ $data->doanhthu_max}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
