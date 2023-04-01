import axios from 'axios'
export default {
  async login(payload) {
    try {
      const response = await axios.post('http://0.0.0.0/api/login', payload)
      const { data, status } = response.data
      return { data, status }
    } catch (error) {
      const { errors } = error.response.data
      return { status: error.status, errorMsg: errors?.email[0] }
    }
  },
}
