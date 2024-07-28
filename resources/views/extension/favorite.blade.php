<style>
 .text-black {
     color: black !important;
 }
</style>
@extends("layouts.main")

@section("title")
Favorites
@endsection
@section("content")
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Favorites</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Favorites</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Favorites Section Begin -->
    <section class="favorites spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="favorites__table">
                     <table class="table">
                      <thead>
                          <tr>
                              <th class="favorites__product">Products</th>
                              <th>Price</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($items as $item)
                          @php
                          $ph = json_decode($item["photos"]);
                          $firstPhoto = $ph[0];
                          
                          @endphp
                          <tr id="favorites-item-{{ $item['id'] }}">
                              <td class="favorites__item">
                                  <img src="{{ asset('storage/' . $firstPhoto) }}" alt="" style="width: 100px; height: 100px;">
                                  <h5>{{ $item['name'] }}</h5>
                              </td>
                              <td class="favorites__price">
                                  ${{ number_format($item['price'], 2) }}
                              </td>

                              <td>
                               <a href="{{ route('cart.addOne', ['id' => $item['id'], 'qa' => 1]) }}" class="btn btn-success text-black">add to cart</a>
                           </td>
                           
                              <td class="favorites__item__close">
                                  <form action="{{ route('favorites.remove') }}" method="POST" style="display: inline;">
                                      @csrf
                                      <input type="hidden" name="id" value="{{ $item['id'] }}">
                                      <button type="submit" class="btn p-0" style="border: 2px solid #7FAD39; background-color: white; color: #7FAD39; border-radius: 50%; padding: 5px 10px; cursor: pointer;" title="Remove item">
                                          <i class="bi bi-x" style="font-size: 1.5rem;"></i>
                                      </button>
                                  </form>
                              </td>

                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Favorites Section End -->
@endsection
