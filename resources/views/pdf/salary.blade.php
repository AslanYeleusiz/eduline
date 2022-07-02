
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Salary Calculate</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
{{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet"> --}}

  </head>
  <style>
    @font-face {
        font-family: 'arial_uni';
        src: url('fonts/arial_test.ttf') format('truetype');
        /* src: url('fonts/arialuni.ttf') format('truetype'); */
        font-weight: 400;
        font-style: normal;
    }
    * {
    box-sizing: border-box;
    scroll-behavior: smooth;
    font-family: arial_uni;

    /*transition: all 0.3s ease 0s;*/
}
.table-bordered td, .table-bordered th {
    padding: 0.75rem;
    vertical-align: top;
    /* border-top: 1px solid #dee   2e6; */
    border: 1px solid black;
}
  </style>
  <body>
    <h2 class="title" style="text-align: center; margin-bottom: 20px">Калькулятор для расчета заработной платы</h2>
<b style="font-size: 20px;
        font-weight: 600;margin-bottom: 10px">  Данные</b>
    <table class="table table-bordered" style="border:2px solid black;
    margin-top:20px
    ">
      <tr>
        <td>
          $user->full_name}}
        </td>
        <td>
          $user->street_address}}
        </td>
      </tr>
      <tr>
        <td>
          $user->city}}
        </td>
        <td>
          $user->zip_code}}
        </td>
      </tr>
    </table>
  </body>
</html>
