export const getUser = () => {
  const user = localStorage.getItem('user') || 'null'
  return JSON.parse(user)
}

export const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
}

