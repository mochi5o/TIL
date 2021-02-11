!# /usr/bin/ruby

require 'optparse'
require 'etc'

@arr = []
@base_dir = ''
options = ARGV.getopts('arl')
ARGV[0].nil? ? @base_dir = Dir.getwd : @base_dir = ARGV[0]

def get_files_list
  file_list = Dir.entries(@base_dir)
  file_list.each do |file|
    file = "#{file}/" if Dir.exist?("#{@base_dir}/#{file}")
    @arr.push file
  end
  @arr.sort!
end

def without_a_opt
  @arr.select! { |list| !list.start_with?(".") }
end

def with_r_opt
  @arr.reverse!
end

def without_l_output
  max_length = @arr.sort_by(&:length).last.length
  @arr.map! do |s|
    s.ljust(max_length + 2)
  end

  remainder = @arr.length % 3
  if @arr.length % 3 == 1
    @arr.push('','')
  elsif @arr.length % 3 == 2
    @arr.push('')
  end

  without_l_opt_show = @arr.each_slice(@arr.length.div(3)).to_a.transpose

  without_l_opt_show.each do |a|
  puts a.join('')
  end
end

def with_l_output
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

  total = 0
  @arr.each do |f|
    total += File.stat("#{@base_dir}/#{f}").blocks
  end

  str = ''
  @arr.each do |f|
    stat = File.stat("#{@base_dir}/#{f}")
    # f = "#{f}/" if stat
    mode_arr = stat.mode.to_s(8).split(//)[-3..]
    mode = ''
    mode_arr.each do |n|
      mode += permit[n.to_i]
    end
    type = types[stat.ftype]
    nlink = stat.nlink.to_s.rjust(3)
    owner = Etc.getpwuid(stat.uid).name
    gid   = stat.gid
    size  = stat.size.to_s.rjust(6)
    mtime = stat.mtime
    month = month_name[mtime.month- 1]
    day   = mtime.day.to_s.rjust(2)
    hour  = mtime.hour.to_s.rjust(2, "0")
    min   = mtime.min.to_s.rjust(2, "0")
    str += "#{type}#{mode} #{nlink} #{owner}  #{gid}  #{size} #{month}  #{day} #{hour}:#{min} #{f}\n"
  end

  puts "total #{total}"
  puts str
end

get_files_list
without_a_opt if !options['a']
with_r_opt if options['r']
options['l'] ? with_l_output : without_l_output
