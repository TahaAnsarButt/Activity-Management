<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <table class="table table-bordered table-stripped table-responsive " id="defualtTable1" style="width: 100%;">
            <thead class="bg-primary-600">
                <tr>
                    <th>Department</th>
                    <th>Class Name</th>
                    <th>Employee Name</th>
                    <th>Card No</th>
                    <?php foreach ($dates as $date) : ?>
                        <th><?php echo $date; ?></th>
                    <?php endforeach; ?>
                    <th>Total Prayer</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (isset($storedata)) {
                    foreach ($storedata as $st) {

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($st['DeptName']) . "</td>";
                        echo "<td>" . htmlspecialchars($st['Class']) . "</td>";
                        echo "<td>" . htmlspecialchars($st['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($st['CardNo']) . "</td>";

                        $dynamicColumnCount = 0;
                        foreach ($st as $key => $value) {

                            if (!in_array($key, ['DeptName', 'Class', 'CardNo', 'Name', 'Total'])) {

                                $displayValue = isset($value) ? $value : '0';
                                echo "<td>" . htmlspecialchars($displayValue) . "</td>";
                                $dynamicColumnCount++;
                            }
                        }

                        $additionalTds = count($dates) - $dynamicColumnCount;

                        for ($i = 0; $i < $additionalTds; $i++) {
                            echo "<td></td>";
                        }

                        echo "<td>" . htmlspecialchars($st['Total']) . "</td>";

                        echo "</tr>";
                    }
                }
                ?>




            </tbody>




        </table>
    </div>
</div>

<script>
    $('#defualtTable1').dataTable({
        responsive: false,
        lengthChange: false,
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