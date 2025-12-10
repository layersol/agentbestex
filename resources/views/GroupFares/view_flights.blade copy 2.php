@include('layouts.header')

<div class="bodyload" style="margin-top:80px;display:none">
 <div class="rotatingDiv"></div>
</div>

<main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
  font-family: "Poppins", sans-serif;
  background: #f5f6fa;
  margin: 20px;
}

/* ✈️ Flight Card */
.flight-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  overflow: hidden;
  max-width: 1100px;
  margin: auto;
  margin-bottom: 20px;
  
  transition: all 0.3s ease;
}

.flight-grid {
  display: grid;
  grid-template-columns: 1.5fr 1.5fr 1.5fr 1.5fr 2fr;
  align-items: center;
  gap: 10px;
  padding: 15px 20px;
  background: #fff;
}

.flight-grid .col { text-align: center; }

.airline img { width: 100px; }
.airline strong { font-size: 15px; display: block; }
.airline small { color: #777; }

.route h6 { margin: 0; font-size: 16px; color: #222; }
.duration i { color: #333; }
.price p { font-size: 18px; font-weight: bold; color: #e60000; margin: 0 0 5px 0; }

.select-btn {
  background: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 6px 12px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.3s;
}
.select-btn:hover { background: #0056b3; }

/* 🔽 Details Section with Slide Animation */
.details {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s ease-in-out;
  background: #fafafa;
  border-top: 1px solid #eee;
  padding: 0 20px;
}
.details.show {
  max-height: 1000px;
  padding: 20px;
}

.details-left, .details-right {
  flex: 1;
  min-width: 320px;
  padding: 10px;
}
.details-right {
  border-left: 1px solid #eee;
}

.toggle-details {
  text-align: right;
  padding: 12px 24px;
  font-weight: 500;
  cursor: pointer;
  color: #007bff;
  border-top: 1px solid #eee;
}
.toggle-details i {
  margin-left: 6px;
  transition: transform 0.3s;
}

.counter {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0;
}
.counter button {
  width: 32px;
  height: 32px;
  border: none;
  color: white;
  font-size: 18px;
  border-radius: 6px;
  cursor: pointer;
}
.counter button.minus { background: #d9534f; }
.counter button.plus { background: #5cb85c; }

.counter input {
  width: 50px;
  text-align: center;
  border: none;
  font-size: 16px;
  background: #f3f3f3;
  border-radius: 6px;
}

.total {
  font-size: 22px;
  color: #e60000;
  font-weight: bold;
  text-align: right;
  margin-top: 10px;
}

.book-btn {
  background: #e60000;
  color: white;
  border: none;
  width: 100%;
  padding: 12px;
  border-radius: 6px;
  font-size: 18px;
  margin-top: 10px;
  cursor: pointer;
  transition: 0.3s;
}
.book-btn:hover { background: #b80000; }

.empty { padding: 20px; text-align: center; }

/* 📱 Mobile Layout */
@media (max-width: 767px) {
  .flight-grid {
    display: block;
    text-align: center;
    padding: 15px;
  }
  .airline img {
    width: 80px;
    margin: 10px auto;
    display: block;
  }
  .flight-card .price {
    margin-top: 10px;
  }
  .details {
    flex-direction: column;
  }
  .details-right {
    border-left: none;
    border-top: 1px solid #eee;
    margin-top: 15px;
  }
}
</style>
<div class="container" style="margin-top:100px;">
@if (empty($result))
  <div class="empty">No flights found for your search.</div>
@else
  @foreach ($result as $row)

<?php  

// print_r($row);
?>
  <div class="flight-card">
    <div class="flight-grid">
      <!-- 1️⃣ Airline -->
      <div class="col airline">
        <div>
          <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/{{ $row['airline_code'] }}.svg" alt="logo"><br>
          <strong>{{ $row['airline_name'] }}</strong>
          <small>{{ $row['airline_code'] }}-{{ $row['number'] }}</small>
        </div>
      </div>

      <!-- 2️⃣ Departure -->
      <div class="col route">
        <h6>{{ strtoupper($row['departure_airport']) }} ({{ strtoupper($row['departure_city']) }})</h6>
        <h3>{{ date('h:i A', strtotime($row['departure_time'])) }}</h3>
        <small>{{ $row['departure_date'] }}</small>
      </div>

      <!-- 3️⃣ Duration -->
      <div class="col duration">
        @php
          $departure = new DateTime($row['departure_time']);
          $arrival = new DateTime($row['arrival_time']);
          $interval = $departure->diff($arrival);
          $duration = $interval->format('%h hr %i min');
        @endphp
        <i class="fa-regular fa-clock"></i> {{ $duration }}
        <hr>
        <i class="fa-solid fa-suitcase-rolling"></i> {{ $row['baggaes'] }} KG
      </div>

      <!-- 4️⃣ Arrival -->
      <div class="col availability">
        <h6>{{ strtoupper($row['arrival_airport']) }} ({{ strtoupper($row['arrival_city']) }})</h6>
        <h3>{{ date('h:i A', strtotime($row['arrival_time'])) }}</h3>
        <small>{{ $row['departure_date'] }}</small>
      </div>

      <!-- 5️⃣ Price -->
      <div class="col price">
        <p><strong>{{ $row['currency'] }} {{ number_format($row['adult_price'], 2) }}</strong></p>
        {{ $row['seats'] }} seats left<br>
        ({{ $row['status'] == 'YES' ? 'available' : 'not available' }})
        <input type="hidden" id="seatAvailable{{ $row['id'] }}" value="{{ $row['seats'] }}">
         
      </div>
    </div>

   <div class="toggle-details btn btn-primary" onclick="toggleDetails(this)">
      Details <i class="fa fa-chevron-down"></i>
    </div>

    <div class="row details">
      <div class="col-lg-12 col-md-6">
        <h4>Flight Details</h4>
        <p><strong>Departure:</strong> ({{ strtoupper($row['departure_airport']) }}) – {{ $row['departure_date'] }}, {{ date('H:i A', strtotime($row['departure_time'])) }}</p>
        <p><strong>Arrival:</strong> ({{ strtoupper($row['arrival_airport']) }}) – {{ $row['arrival_date'] ?? $row['departure_date'] }}, {{ date('H:i A', strtotime($row['arrival_time'])) }}</p>

        <div class="price-list">
          <p>Adult: {{ $row['currency'] }} <span id="adultPrice{{ $row['id'] }}">{{ $row['adult_price'] }}</span></p>
          <p>Child: {{ $row['currency'] }} <span id="childPrice{{ $row['id'] }}">{{ $row['child_price'] }}</span></p>
          <p>Infant: {{ $row['currency'] }} <span id="infantPrice{{ $row['id'] }}">{{ $row['infant_price'] }}</span></p>
        </div>
      </div>

      <div class="col-lg-12 col-md-6">
        <div class="counter">
          <span>Adult</span>
          <div>
            <button class="minus" onclick="updateCount({{ $row['id'] }}, 'adult', -1)">-</button>
            <input type="text" id="adultCount{{ $row['id'] }}" value="1" readonly>
            <button class="plus" onclick="updateCount({{ $row['id'] }}, 'adult', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Child</span>
          <div>
            <button class="minus" onclick="updateCount({{ $row['id'] }}, 'child', -1)">-</button>
            <input type="text" id="childCount{{ $row['id'] }}" value="0" readonly>
            <button class="plus" onclick="updateCount({{ $row['id'] }}, 'child', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Infant</span>
          <div>
            <button class="minus" onclick="updateCount({{ $row['id'] }}, 'infant', -1)">-</button>
            <input type="text" id="infantCount{{ $row['id'] }}" value="0" readonly>
            <button class="plus" onclick="updateCount({{ $row['id'] }}, 'infant', 1)">+</button>
          </div>
        </div>

        <div class="total">{{ $row['currency'] }} <span id="totalFare{{ $row['id'] }}">{{ number_format($row['adult_price'], 2) }}</span></div>
        
        <form method="POST" action="{{ route('book.flight') }}">
          @csrf
          <input type="hidden" name="flight" value='{{ json_encode($row) }}'>
          <input type="hidden" name="flight_id" value="{{ $row['id'] }}">
          <input type="hidden" name="adult_count" id="adultInput{{ $row['id'] }}" value="1">
          <input type="hidden" name="child_count" id="childInput{{ $row['id'] }}" value="0">
          <input type="hidden" name="infant_count" id="infantInput{{ $row['id'] }}" value="0">
          <input type="hidden" name="total_fare" id="fareInput{{ $row['id'] }}" value="{{ number_format($row['adult_price'], 2) }}">
          <button type="submit" class="book-btn">BOOK NOW</button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
@endif
</div>
<script>
function toggleDetails(el) {
  const details = el.nextElementSibling;
  const icon = el.querySelector("i");
  details.classList.toggle("show");
  icon.style.transform = details.classList.contains("show") ? "rotate(180deg)" : "rotate(0deg)";
}

function updateCount(id, type, change) {
  const adultInput = document.getElementById("adultCount" + id);
  const childInput = document.getElementById("childCount" + id);
  const infantInput = document.getElementById("infantCount" + id);
  let adult = parseInt(adultInput.value);
  let child = parseInt(childInput.value);
  let infant = parseInt(infantInput.value);
  const seatsLeft = parseInt(document.getElementById("seatAvailable" + id).value);
  let newCount = 0;

  if (type === 'adult') newCount = adult + change;
  if (type === 'child') newCount = child + change;
  if (type === 'infant') newCount = infant + change;

  if (newCount < 0) newCount = 0;
  let totalAdultChild = (type === 'adult' ? newCount : adult) + (type === 'child' ? newCount : child);
  if (totalAdultChild > seatsLeft) newCount = (type === 'adult' ? seatsLeft - child : seatsLeft - adult);
  if (type === 'infant' && newCount > adult) newCount = adult;
  if (type === 'adult' && newCount < infant) infantInput.value = newCount;

  if (type === 'adult') adultInput.value = newCount;
  if (type === 'child') childInput.value = newCount;
  if (type === 'infant') infantInput.value = newCount;
  calculateTotal(id);
}

function calculateTotal(id) {
  const adult = parseInt(document.getElementById("adultCount" + id).value);
  const child = parseInt(document.getElementById("childCount" + id).value);
  const infant = parseInt(document.getElementById("infantCount" + id).value);
  const adultPrice = parseFloat(document.getElementById("adultPrice" + id).textContent);
  const childPrice = parseFloat(document.getElementById("childPrice" + id).textContent);
  const infantPrice = parseFloat(document.getElementById("infantPrice" + id).textContent);
  const total = (adult * adultPrice) + (child * childPrice) + (infant * infantPrice);
  document.getElementById("totalFare" + id).textContent = total.toLocaleString("en-IN", {minimumFractionDigits: 2});
}
</script>

</main>

@include('layouts.footer')
