<!DOCTYPE html>
<html>

<head>

</head>
<body>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <table class="table table-bordered table-stripped table-responsive " id="defualtTable1" >
            <thead class="bg-primary-600">
                <tr>
                    <th style="min-width: 150px;">Department</th>
                    <?php foreach ($dates as $date) : ?>
                        <th><?php echo $date; ?></th>
                    <?php endforeach; ?>
                    <th>Prayer Percentage</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (isset($storedata)) {
                    foreach ($storedata as $st) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($st['DeptName']) . "</td>";
                        
                        $dynamicColumnCount = 0;
                        foreach ($st as $key => $value) {
                            if (!in_array($key, ['DeptName', 'Total'])) {
                                $displayValue = isset($value) ? round($value, 2) . '%' : '0%';
                                echo "<td>" . htmlspecialchars($displayValue) . "</td>";
                                $dynamicColumnCount++;
                            }
                        }

                        $additionalTds = count($dates) - $dynamicColumnCount;

                        for ($i = 0; $i < $additionalTds; $i++) {
                            echo "<td></td>";
                        }

                        $totalPercentage = $st['Total'] !== '-' ? round($st['Total'], 2) . '%' : '0%';
                        // echo "<td>" . htmlspecialchars($totalPercentage) . "</td>";
                        echo "<td data-TotalPercentage>" . htmlspecialchars($totalPercentage) . "</td>";
                        
                        echo "</tr>";
                    }
                    // foreach ($st as $key => $value) {
                    //     if (!in_array($key, ['DeptName', 'Total'])) {
                    //         $displayValue = isset($value) ? round($value, 2) . '%' : '-';
                    //         $dynamicColumnCount++;
                    //     }
                    // }

                    //
                    $additionalTdss = count($dates) - (isset($dynamicColumnCount));

                    // echo "<tr>";
                    // echo "<td>Average Factory Prayers Percentage</td>";
                    // for ($i = 0; $i < count($dates); $i++) {
                    //     echo "<td></td>";
                    // }
                    // // echo "<td colspan='" . (count($dates)) . "'></td>"; // Span the empty cells
                    // echo "<td style='font-weight: bold; font-size: 16px'>" . round($averageTotalPrayerPercentage, 2) . "%</td>"; // Output the average total prayer percentage
                    // echo "</tr>";
                }
                ?>





            </tbody>
            <tfoot>
            <?php $additionalTdss = count($dates) - (isset($dynamicColumnCount)); ?>

<tr>
<td style='font-weight: bold'>Average Factory Prayers Percentage</td>
<?php
for ($i = 0; $i < count($dates); $i++) {
    echo "<td></td>";
} ?>
<td style='font-weight: bold; font-size: 16px'> <?php echo round($averageTotalPrayerPercentage, 2) ?>  %</td>
</tr>

            </tfoot>




        </table>
    </div>
</div>

<script>
    $('#defualtTable1').dataTable({
                        ordering: false,
                        responsive: false,
                        lengthChange: true,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All'],
                        ],
                        dom:
                            /*	--- Layout Structure 
                              --- Options
                              l	-	length changing input control
                              f	-	filtering input
                              t	-	The table!
                              i	-	Table information summary
                              p	-	pagination control
                              r	-	processing display element
                              B	-	buttons
                              R	-	ColReorder
                              S	-	Select

                              --- Markup
                              < and >				- div element
                              <"class" and >		- div with a class
                              <"#id" and >		- div with an ID
                              <"#id.class" and >	- div with an ID and a class

                              --- Further reading
                              https://datatables.net/reference/option/dom
                              --------------------------------------
                             */
                            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                            /*{
                              extend:    'colvis',
                              text:      'Column Visibility',
                              titleAttr: 'Col visibility',
                              className: 'mr-sm-3'
                            },*/
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                titleAttr: 'Generate PDF',
                                className: 'btn-outline-danger btn-sm mr-1'
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel',
                                titleAttr: 'Generate Excel',
                                className: 'btn-outline-success btn-sm mr-1'
                            },
                            {
                                extend: 'csvHtml5',
                                text: 'CSV',
                                titleAttr: 'Generate CSV',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'copyHtml5',
                                text: 'Copy',
                                titleAttr: 'Copy to clipboard',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                titleAttr: 'Print Table',
                                className: 'btn-outline-primary btn-sm'
                            }
                        ]
                    });

</script>
</body>
</html>

