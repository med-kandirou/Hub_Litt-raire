import axios from "axios";

const getLivre = async function () {
    try {
        const response = await axios.get('/api/posts');
        return response.data;
    } catch (error) {
        console.log(error.data)
        return [];

    }

}