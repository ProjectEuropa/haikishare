{{ $company->name }}{{ $company->store }}の出品した商品が購入されました。<br>
<br>
商品については以下のとおりです。<br>
<br/>
商品名　{{ $product->name}}<br>
値段　{{ $product->discount}}円<br>
店舗名　{{$company->name}}{{$company->store}}<br>
住所　{{ $company->address}}<br>
<br>
商品コード　{{ $password }}
