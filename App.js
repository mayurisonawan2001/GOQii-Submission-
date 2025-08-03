import React, { useState, useEffect } from 'react';

function App() {
    const [users, setUsers] = useState([]);
    const [form, setForm] = useState({ name: '', email: '', password: '', dob: '' });

    useEffect(() => {
        fetch('http://localhost/user-management-api/user_api.php')
            .then(res => res.json())
            .then(data => setUsers(data));
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();
        fetch('http://localhost/user-management-api/user_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(form),
        }).then(() => window.location.reload());
    };

    return (
        <div>
            <h1>User Management</h1>
            <form onSubmit={handleSubmit}>
                <input type="text" placeholder="Name" onChange={(e) => setForm({...form, name: e.target.value})} required />
                <input type="email" placeholder="Email" onChange={(e) => setForm({...form, email: e.target.value})} required />
                <input type="password" placeholder="Password" onChange={(e) => setForm({...form, password: e.target.value})} required />
                <input type="date" onChange={(e) => setForm({...form, dob: e.target.value})} required />
                <button type="submit">Add User</button>
            </form>
            <ul>
                {users.map(user => (
                    <li key={user.id}>{user.name} - {user.email}</li>
                ))}
            </ul>
        </div>
    );
}

export default App;
