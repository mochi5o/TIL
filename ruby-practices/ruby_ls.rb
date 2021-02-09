require 'optparse'
require 'etc'

# TODO:カレントディレクトリの情報 || 引数で渡したディレクトリ
base_dir = Dir.getwd

arr = []
file_list = Dir.entries(base_dir)
file_list.each do |file|
  # file = "#{file}/" if Dir.exist?("#{base_dir}/#{file}")
  arr.push file
end

# ファイルの順番がととのった
arr.sort!

def without_a_opt(array)
  puts '-----'
  array.select! { |list| !list.start_with?(".") }
  # puts arr
end

def with_r_opt
  puts '-----'
  arr.reverse!
  puts arr
end

# いいかんじで並べるための処理
max_length = arr.sort_by(&:length).last.length
arr.map! do |s|
  s.ljust(max_length + 2)
end

remainder = arr.length % 3
if arr.length % 3 == 1
  arr.push('','')
elsif arr.length % 3 == 2
  arr.push('')
end

without_l_opt_show = arr.each_slice(arr.length.div(3)).to_a.transpose

without_l_opt_show.each do |a|
puts a.join('')
end


def with_l_output

end

month_name = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
permit = ['---', '--x', '-w-', '-wx', 'r--', 'r-x', 'rw-', 'rwx']
types = {
      'file' => '-',
      'directory' => 'd',
      'characterSpecial' => 'c',
      'blockSpecial' => 'b',
      'fifo' => 'f',
      'link' => 'l',
      'socket' => 's'
}

# total = 0
# arr.each do |f|
#   total += File.stat(f).blocks
# end


# str = ''
# arr.each do |f|
#   stat = File.stat(f)
#   # blocks += stat.blocks
#   mode_arr = stat.mode.to_s(8).split(//)[-3..]
#   mode = ''
#   mode_arr.each do |n|
#     mode += permit[n.to_i]
#   end
#   type = types[stat.ftype]
#   nlink = stat.nlink
#   owner = Etc.getpwuid(stat.uid).name
#   gid   = stat.gid
#   size  = stat.size
#   mtime = stat.mtime
#   month = month_name[mtime.month- 1]
#   day   = mtime.day
#   hour  = mtime.hour
#   min   = mtime.min
#   str += "#{type}#{mode} #{nlink} #{owner}  #{gid}  #{size} #{month}  #{day} #{hour}:#{min} #{f}\n"
# end

# puts "total #{total}"
# puts str
