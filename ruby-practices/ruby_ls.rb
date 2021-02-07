require 'optparse'
require 'etc'

base_dir = Dir.getwd
puts base_dir

arr = []
file_list = Dir.entries(base_dir)
file_list.each do |file|
  # file = "#{file}/" if Dir.exist?("#{base_dir}/#{file}")
  arr.push file
end

arr.sort!

def without_a_opt
  puts '-----'
  arr.select! { |list| !list.start_with?(".") }
  puts arr
end

def with_r_opt
  puts '-----'
  arr.reverse!
  puts arr
end

def with_l_opt

end

# arr = ['ruby_pwd', 'test']

month_name = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
permit = ['---', '--x', '-w-', '-wx', 'r--', 'r-x', 'rw-', 'rwx']
blocks = 0
str = ''
arr.each do |f|
  stat = File.stat(f)
  blocks += stat.blocks
  m_str = stat.mode.to_s(8)
  # puts m_str
  pam_arr = m_str.split(//)
  mode_arr = pam_arr.last(3)
  mode = ''
  mode_arr.each do |n|
    mode += permit[n.to_i]
  end

  nlink = stat.nlink
  owner = Etc.getpwuid(stat.uid).name
  gid   = stat.gid
  size  = stat.size
  mtime = stat.mtime
  month = month_name[mtime.month- 1]
  day   = mtime.day
  hour  = mtime.hour
  min   = mtime.min
  str += "#{mode}  #{nlink} #{owner}  #{gid}  #{size} #{month}  #{day} #{hour}:#{min} #{f}\n"
end

puts "total #{blocks}"
puts str

def get_mtime(mtime)
  time_show =''
  month = mtime.month
  hour = mtime.hour
  min = mtime.min
  puts hour
end