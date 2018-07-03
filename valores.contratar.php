<?php include '_config/debug.php'; ?>
<?php 
    require_once '_ref/header.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Assinatura</title>

	<style>

#espaco{
  height: 78px;
}

h3, h4{
  text-align: center;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

#table{
  height: 50vh;
  width: 100vw;

  display: flex;
  justify-content: center;
  align-items: center;

  font-size: 20px;
}

ul{
  list-style-type: none;
  text-align: center;
}

</style>
</head>
<body>

<div id="espaco">Branco</div>

<h4>Estes são nossos planos que são disonibilizados a vocês para a contratação</h4>
<div id="table">
  <table>
    <tr>
      <th>Plano</th>
      <th>áreas de consultoria</th>
      <th>Vantagens</th>
    </tr>
    <tr>
      <td>Bronze</td>
      <td>2 áreas</td>
      <td></td>
    </tr>
    <tr>
      <td>Prata</td>
      <td>4 áreas</td>
      <td></td>
    </tr>
      <tr>
      <td>Ouro</td>
      <td>todas as áreas</td>
      <td></td>
    </tr>

  </table>
</div>

<h3>Planos de 6 meses</h3>
<div id="table"><table>
    <tr>
      <th>Plano</th>
      <th>valor do plano</th>
    </tr>
    <tr>
      <td>Bronze</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
    <tr>
      <td>Prata</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
    <tr>
      <td>Ouro</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
</table></div>

<h3>Planos de 1 ano</h3>
<div id="table"><table>
    <tr>
      <th>Plano</th>
      <th>valor do plano</th>
    </tr>
    <tr>
      <td>Bronze</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
     <tr>
      <td>Prata</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
    <tr>
      <td>Ouro</td>
      <td> R$ XXX</td>
      <td>
        <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
          <input type="hidden" name="code" value="3371D7DE8080220DD42A7F8D509D2B70" />
          <input type="hidden" name="iot" value="button" />
          <button type="submit" name="pagamento">assine aqui</button>
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
      </td>
    </tr>
</table></div>
  
</body>
</html>