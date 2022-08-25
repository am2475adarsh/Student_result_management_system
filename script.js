function jujj(id) {
    // window.location.href = "result.php?id=" + document.getElementById(id).value + "&" + "result=" + document.getElementById(id + 'abc').value + "&" + "status=" + document.getElementById(id + 'def').value;

    fetch("index.php?id=" + document.getElementById(id).value + "&" + "result=" + document.getElementById(id + 'abc').value + "&" + "status=" + document.getElementById(id + 'def').value);

    alert("Record Edited");

}

function myfunc(id) {
    const menu = document.querySelectorAll('.details');
    const main = document.querySelectorAll('.container');

    for (i = 0; i < menu.length; i++) {
        menu[i].classList.remove('active');
        main[i].classList.remove('active2');
    }
    document.getElementById(id).classList.add('active');
    document.getElementById(id + 'cont').classList.add('active2');

}



function refresh() {
    // $(document).ready(function() {

    //     $('#results').load("results.php");

    // });
    window.location.href = "result.php#results";
}

function exportData() {

    var table = document.getElementById("table");

    var rows = [];

    for (var i = 0, row; row = table.rows[i]; i++) {

        column1 = row.cells[0].innerText;
        column2 = row.cells[1].innerText;
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
        column5 = row.cells[4].innerText;
        column6 = row.cells[5].innerText;
        column7 = row.cells[6].innerText == '' ? row.cells[6].firstChild.value : row.cells[6].innerText;
        column8 = row.cells[7].innerText == '' ? row.cells[7].firstChild.value : row.cells[7].innerText;

        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8

            ]
        );

    }
    // console.log(rows);
    csvContent = "data:text/csv;charset=utf-8,";

    rows.forEach(function(rowArray) {
        row = rowArray.join(",");
        csvContent += row + "\r\n";
    });


    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "Student_Result_Status.csv");
    document.body.appendChild(link);

    link.click();
}


function tableShow(param) {
    // console.log(data);


    let table = document.getElementById('table');
    table.innerHTML = `<tr style='font-weight:bold;font-size:17px;color:#349fb0;height:10%;'>
                    <th>SNo.</th>
                    <th>Full Name</th>

                    <th>Registration No.</th>

                    <th>University</th>
                    <th>Course</th>
                    <th>Sub Course</th>
                    <th>Result</th>
                    <th>Result Status</th>


                </tr>`;
    let input = document.getElementById('univ').value;
    for (let i = 1; i < data.length; i++) {
        if (input.length == 0) {
            let tr = document.createElement('tr');
            tr.id = 'lola';
            tr.style.color = 'rgb(0,0,0,0.9)';
            let td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = i;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['student'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<input type='hidden' id='${data[i]['id']}' value='${data[i]['id']}' name='id'/>` + data[i]['regno'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['univ'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['course'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['subcourse'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<input id='${data[i]['id']+'abc'}' value='${data[i]['result']}' name='id'/>`;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            // console.log(td.innerHTML = data[i]['res_status'], `${data[i]['id']+'def'}`);
            td.innerHTML = data[i]['res_status'] === "confirmed" ?

                `<td style='text-align:center'><select name='status' id='${data[i]['id']+'def'}'>
          <option value='confirmed'>confirmed</option>
          <option value='unconfirmed'>unconfirmed</option>
        </select></td>` :

                `<td style='text-align:center'><select name='status' id='${data[i]['id']+'def'}'>
                    <option value='unconfirmed'>unconfirmed</option>
                    <option value='confirmed'>confirmed</option>
                  </select></td>`;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<div class='butt_on' style = "cursor: pointer;" onclick='jujj(${data[i]['id']})'>Edit</div>`;
            tr.appendChild(td);
            table.appendChild(tr);
        } else if (data[i]['univ'].includes(input)) {
            let tr = document.createElement('tr');
            tr.style.color = 'rgb(0,0,0,0.9)';
            let td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = i;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['student'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<input type='hidden' id='${data[i]['id']}' value='${data[i]['id']}' name='id'/>` + data[i]['regno'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['univ'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['course'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['subcourse'];
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<input id='${data[i]['id']+'abc'}' value='${data[i]['result']}' name='id'/>`;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = data[i]['res_status'] === 'confirmed' ? `<select name='status' id='${data[i]['id']+'def'}'>
                    <option value='unconfirmed'>unconfirmed</option>
                    <option value='confirmed'>confirmed</option>
                  </select></td>` : `<td style='text-align:center'><select name='status' id='${data[i]['id']+'def'}'>
                    <option value='confirmed'>confirmed</option>
                    <option value='unconfirmed'>unconfirmed</option>
                  </select>`;
            tr.appendChild(td);
            td = document.createElement('td');
            td.style = 'text-align:center';
            td.innerHTML = `<div class='butt_on' style="cursor: pointer;" onclick='jujj(${data[i]['id']})'>Edit</div>`;
            tr.appendChild(td);
            table.appendChild(tr);
        }
    }


}