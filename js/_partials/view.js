const fetchTracking = async ()=>{
    try {
        const response = await fetch('load_tracked_shipment.php', {
            method:"POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/html",
            },
            body:({}),
        }).then(response=>{
            return response.json()
        }).then(data=>{
            //console.log(data);
            const tr="border:1px solid #bbb;color:white;background:black;text-align:center; font-weight:bold;padding:5px;width:15vw;"
            const tr_body="border:1px solid black; text-align:center;padding:5px;"
            const styleOption="border:none;background:white;"
            const btnStyle="border:none; background:green; color:white;display:inline;padding:5px;border-radius:5px;margin:2px;"
            let output = `
            <div>
                <table>
                    <thead>
                        <th style="${tr}">MAIN BL</th>
                        <th style="${tr}">HOUSE BL</th>
                        <th style="${tr}">ETA</th>
                        <th style="${tr}">STATUS</th>
                        <th style="${tr}">ACTION</th>
                    </thead>
            `;
            data.data.forEach(item=>{
                output +=`
            
                    <tr class="shipment_web_tracking" id="${item.MainBL}">
                        <td style="${tr_body}">${item.MainBL}</td>
                        <td style="${tr_body}">${item.HouseBL}</td>
                        <td style="${tr_body}"><input type="date" value="${formatDate(item.ETA)}"/></td>
                        <td style="${tr_body}">${item.ArrivalStatus}</td>
                        <td style="${tr_body}">
                            <select style="${styleOption}">
              <option>${item.ArrivalStatus}</option>
                                <option>On the way</option>
                                <option>Arrived</option>
                                <option>Arrived and Unstuffed</option>
                            </select>                
                        </td>
                        <td>
            <button style="${btnStyle}" class="btn-update-track-shipment">Update</button>
          </td>
          <td>
            <button style="${btnStyle}" class="btn-done-track-shipment">Done</button>
          </td>
                    </tr>
                    
                `;
            })
            output+=`
                </tbody>
                </table>
            </div>
            `
            console.log(output);
            document.getElementById('display_tracked_shipment_status').innerHTML = output

        })
    } catch (err) {
        console.warn(`Error detected: ${err}`)
    }
    
}

fetchTracking();