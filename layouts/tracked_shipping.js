export function trackedShipping(data){
    let output="";

    data.forEach(item=>{
        output +=`
            <div>${item.data.ETA}</div>
        `
    })
}