<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
        }
        .header img {
            max-width: 150px;
        }
        .header h1 {
            margin: 0;
        }
        .details, .summary, .transactions {
            margin-bottom: 20px;
        }
        .details table, .summary table, .transactions table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th, .details td, .summary th, .summary td, .transactions th, .transactions td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .transactions th {
            background-color: #f2f2f2;
        }
        .summary th, .summary td {
            text-align: left;
        }
        .footer {
            margin-top: 40px;
        }
        .signature {
            margin-top: 50px;
        }
        .signature .name, .signature .signature-field {
            display: inline-block;
            width: 45%;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
          <div style="float: left;">

            <img src="data:image/png;base64, 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" >

          </div>
          <h4>D' SAN ROQUE DAYONG PROVIDERS INC.</h4>
          <p>BRGY. 74-A MATINA CROSSING DAVAO CITY</p>
          <p>DAILY REPORT FOR {{ strtoupper($date); }}</p>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Date</th>
                    <td>{{ strtoupper($date); }}</td>
                </tr>
                <tr>
                    <th>Branch Name</th>
                    <td>
                        {{ $branch; }}
                    </td>
                </tr>
                <tr>
                    <th>Cashiers Name</th>
                    <td>{{ strtoupper($cashier); }}</td>
                </tr>
                
            </table>
        </div>
        <div class="transactions">
            <h2>New Sales</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Accounts</th>
                        <th>Gross</th>
                        <th>Incentives</th>
                        <th>Net</th>
                        <th>Fidelity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results_ns as $nsr)
                        <tr>
                            <th>{{ $nsr->user_name; }}</th>
                            <th>{{ $nsr->number_of_accounts; }}</th>
                            <th>{{ $nsr->total_amount; }}</th>
                            <th>{{ $nsr->total_incentives; }}</th>
                            <th>{{ $nsr->total_net; }}</th>
                            <th>{{ $nsr->total_fidelity; }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
        <div class="transactions">
            <h2>Collections</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Accounts</th>
                        <th>Gross</th>
                        <th>Incentives</th>
                        <th>Net</th>
                        <th>Fidelity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($col_result as $colr)
                        <tr>
                            <th>{{ $colr->name; }}</th>
                            <th>{{ $colr->accounts; }}</th>
                            <th>{{ $colr->gross; }}</th>
                            <th>{{ $colr->incentives; }}</th>
                            <th>{{ $colr->net; }}</th>
                            <th>{{ $colr->fidelity; }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- div class="details">
            <h2>Branches</h2>
            <table>
                <tr>
                    <th>Branch ID</th>
                    <th>Branch</th>
                </tr>

             
                <tr>
                    <th>Due Date</th>
                    <td>July 16, 2024</td>
                </tr>
                <tr>
                    <th>Account Holder</th>
                    <td>John Doe</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>123456789</td>
                </tr>
                <tr>
                    <th>Statement Date</th>
                    <td>June 16, 2024</td>
                </tr>
               
                
            </table>
        </div>  -->
        <div class="summary">
            <h2>Summary</h2>
            <table>
                <tr>
                    <th>Previous Balance</th>
                    <td>$500.00</td>
                </tr>
                <tr>
                    <th>Payments</th>
                    <td>$200.00</td>
                </tr>
                <tr>
                    <th>New Charges</th>
                    <td>$150.00</td>
                </tr>
                <tr>
                    <th>New Balance</th>
                    <td>$450.00</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="signature">
                <div class="name">
                    <p>_______________________________</p>
                    <p> Finance Department </p>
                </div> <br>
                <div class="signature-field">
                  <p>_______________________________</p>
                  <p> Encoder </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
