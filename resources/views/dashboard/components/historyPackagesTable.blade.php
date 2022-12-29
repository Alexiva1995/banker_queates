<div class="col-md-6 row-top" >
    <div class="card p-2">
        <div class="card-body p-0">
            <h5 class=" fw-bolder">Packages History </h5>
            <div class="table-responsive">
                <table class="text-capitalize table nowrap scroll-horizontal-vertical row-border myTable  w-100" id="packagesTable">
                  <thead class="mt-50">
                    <tr>
                      <th class="py-2 d-none d-sm-table-cell">Date</th>
                      <th class="py-2">Package</th>
                      <th class="py-2">Price</th>
                      <th class="py-2">Profits</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($investments as $investment)
                      <tr class="py-2">
                          <td class="d-none d-sm-table-cell">
                            {{ $investment->created_at->format('d/m/Y H:i:s') 
                          }}</td>
                          <td>{{ $investment->licensePackage->name }}</td>
                          <td style="text-align: right">{{ number_format($investment->licensePackage->amount, 2, ',', '.') }}</td>
                          <td style="text-align: right">{{ number_format($investment->gain, 2, ',', '.') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
