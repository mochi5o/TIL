# frozen_string_literal: false

require 'optparse'
options = ARGV.getopts('ab')

puts options
puts ARGV[0].nil?
puts ARGV[0]

puts 'a' if options['a']
puts 'b' if options['b']
