export async function deleteUser(event){
    event.preventDefault();

    const form = event.target.form;
    const user_id = form.querySelector("input[name='user_id']").value;

    const connection = await fetch(`/php-exam/user/${user_id}`, {
        method : "DELETE"
    });

    if(!connection.ok){
        alert("Could not delete user")
        return;
    };
    
    console.log(connection);
    // const response = await connection.text();
    // const response = await connection.text();

    form.closest(".user").remove()
}
