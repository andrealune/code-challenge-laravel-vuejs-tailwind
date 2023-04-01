import axios from 'axios'
export default {
  async getUser() {
    try {
      const { data } = await axios.get('http://0.0.0.0/api/contacts/')
      return data.data
    } catch (error) {
      console.log(error)
    }
  },

  async addUser(payload) {
    try {
      const { data } = await axios.post('http://0.0.0.0/api/contacts', payload)

      return data
    } catch (error) {
      console.log(error)
    }
  },

  async editUser(id, payload) {
    try {
      const { data } = await axios.put(`http://0.0.0.0/api/contacts/${id}`, payload)

      return data
    } catch (error) {
      console.log(error)
    }
  },

  async onRemove(id) {
    try {
      const token = localStorage.getItem('token')

      const config = {
        headers: { Authorization: `Bearer ${token}` },
      }
      const { data } = await axios.delete(`http://0.0.0.0/api/contacts/${id}`, config)
      return data
    } catch (error) {
      return error.response.status
    }
  },
}
